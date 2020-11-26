<?php
use backend\core\Database;

class Dairy {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
        }
    }

    function get() {
    	$id = (@get('id')) ? get('id') : get_session('userid');
        set_data((new Database())->select('patients_journal', 'user=' . $id));
        return panel_view('dairy');
    }

    function post() {
        $data = array(
            'user' => get_session('userid'),
            'title' => post('title'),
            'mood' => post('mood'),
            'journal' => post('journal'),
            'date' => date('M d, Y h:i a')
        );

        (new Database())->insert('patients_journal', $data);

        address('dairy?status=success');
    }

    function remove() {
        (new Database())->delete('patients_journal', 'id=' . get('id'));
        address('dairy?status=deleted');
    }
}
