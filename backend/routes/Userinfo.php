<?php
use backend\core\Database;

class Userinfo {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
        }
    }

    function get() {
        $appointment_for = (get_session('level') == 1) ? 'patient' : 'doctor';
        $user = (new Database())->select('users', 'id=' . get('id'));
        $appointment = (new Database())->select('appointment', 
        $appointment_for . '=' . get('id'));
        
        $query_graph = 'SELECT SUM(score) AS total_score, SUM(total) AS total_task, month FROM task WHERE patient=' . get('id') . ' GROUP BY month;';

        $graph = (new Database())->query($query_graph);

        set_data(array(
            'info' => $user,
            'appointment' => $appointment,
            'graph' => $graph
        ));

        return panel_view('userinfo');
    }

    function post() {
        (new Database())->update('appointment', array(
            'status' => get('status')
        ), 'id=' . get('appointmentid'));

        address('userinfo?id=' . get('userid'));
    }

    function popular() {
        $current = (new Database())->select('users', 'id=' . get('id'));
        $current = $current[0]['popularity'] + 1;
        $data = array(
            'popularity' => $current
        );
        (new Database())->update('users', $data, 'id=' . get('id'));
        address('userinfo?id=' . get('id'));
    }
}
