<?php
use backend\core\Database;

class Panel {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
        }
    }

    function get() {
        switch(get_session('level')) {
            case 1:
                set_data(array(
                    'request' => count((new Database())->select('doctor_patient_relation', 'doctor=' . get_session('userid') . ' AND status="pending"')),
                    'patient' => count((new Database())->select('doctor_patient_relation', 'doctor=' . get_session('userid') . ' AND status="approve"'))
                ));
                break;
            case 2:
                set_data(array(
                    'doctor' => count((new Database())->select('doctor_patient_relation', 'patient=' . get_session('userid')))
                ));
                break;
            default: break;
        }
        return panel_view('dashboard');
    }
}
