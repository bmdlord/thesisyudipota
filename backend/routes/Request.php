<?php
use backend\core\Database;

class Request {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
            exit();
        }
    }

    function get() {
        $query_statement = '
            SELECT relation.id AS id,
            patient.id AS patient_id,
            patient.fullname AS fullname,
            relation.status AS status
            FROM doctor_patient_relation AS relation 
            JOIN users AS patient 
            ON patient.id = relation.patient 
            WHERE relation.doctor=' . get_session('userid') . ' 
            AND relation.status="pending";
        ';

        set_data((new Database())->query($query_statement));
        return panel_view('request');
    }

    function post() {
        switch(@get('action')) {
            case 'approve':
                
                (new Database())->update('doctor_patient_relation', 
                array(
                    'status' => 'approve'
                ), 'id=' . post('id'));
                
                address('request?status=success');

                break;

            case 'deny':
                
                (new Database())->delete('doctor_patient_relation', 'id=' . post('id'));

                address('request?status=remove');

                break;

            default: break;
        }
    }
}
