<?php
use backend\core\Database;

class Patients {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
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
            AND relation.status="approve";
        ';
        set_data((new Database())->query($query_statement));
        return panel_view('patients');
    }
}
