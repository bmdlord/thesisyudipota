<?php
use backend\core\Database;

class Doctors {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
        }
    }

    function get() {
        switch(@get('view')) {
            case 'my':
                $query_statement = '
                    SELECT relation.id AS id,
                    doctor.id AS doctor_id,
                    doctor.fullname AS fullname,
                    relation.status AS status
                    FROM doctor_patient_relation AS relation 
                    JOIN users AS doctor 
                    ON doctor.id = relation.doctor 
                    WHERE relation.patient=' . get_session('userid') . '
                ';
                set_data((new Database())->query($query_statement));
                return panel_view('mydoctor');
                break;
            case 'list':
                set_data((new Database())->select('users', 'level=1 AND status="active"', 'id, image, fullname, address'));
                return panel_view('doctorlist');
                break;
            default: break;
        }
                
    }

    function post() {
        switch(@get('action')) {
            case 'request':
                $isExists = sizeof((new Database())->select('doctor_patient_relation', '
                    doctor = ' . post('doctor') . ' AND 
                    patient = ' . post('patient') . '
                '));

                if($isExists <= 0) {
                    $data = array(
                        'doctor' => post('doctor'),
                        'patient' => post('patient')
                    );

                    (new Database())->insert('doctor_patient_relation', $data);

                    address('doctors?view=list&status=success');
                } else {
                    address('doctors?view=list&status=exists');
                }
            break;
            case 'remove':
                (new Database())->delete('doctor_patient_relation', 'id=' . post('id'));
                address('doctors?view=my&status=success');
            break;
        }
    }
}
