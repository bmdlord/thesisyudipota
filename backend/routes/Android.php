<?php
use backend\core\Database;

class Android {
    function login() {
        $userEmail = post('username');
        $userPassword = post('password');

        $fetchData = (new Database())->select(
            'users', 
            'email="' . $userEmail . '"');

        if(sizeof($fetchData) > 0) {
            foreach($fetchData as $field) {
                $dbPassword = $field['password'];
                $dbId = $field['id'];
                $dblevel = $field['level'];
            }

            if(password_verify($userPassword, $dbPassword)) {
                $json = '';
                $json .= '{"data":[';
                $json .= json_encode(array('id' => $dbId, 'level' => $dblevel));
                $json .= ']}';

                print($json);
            } else {
                print('invalid');
            }
        } else {
            print('invalid');
        }
    }

    function getdiary() {
        $json = '';
        $json .= '{"data":';
        $json .= json_encode((new Database())->select('patients_journal', 'user=' . get('id')));
        $json .= '}';

        print($json);
    }

    function getevaluation() {
        $json = '';
        $json .= '{"data":';
        $json .= json_encode((new Database())->select('task', 'patient=' . get('id')));
        $json .= '}';

        print($json);
    }

    function newdiary() {
        $data = array(
            'user' => post('id'),
            'title' => post('title'),
            'mood' => post('mood'),
            'journal' => post('story'),
            'date' => date('M d, Y h:i a')
        );

        (new Database())->insert('patients_journal', $data);

        print("ok");
    }

    function get_user_diary() {
        $query_statement = '
            SELECT diary.title AS title,
            diary.mood AS mood,
            diary.journal AS journal,
            user.fullname AS fullname
            FROM patients_journal AS diary
            JOIN users AS user 
            ON diary.user = user.id 
            JOIN doctor_patient_relation AS related 
            ON related.patient = diary.user
            WHERE related.doctor = ' . get('doctor_id') . ' 
            AND related.status="approve";
        ';


        $data = (new Database())->query($query_statement);

        $json = '';
        $json .= '{"data":';
        $json .= json_encode($data);
        $json .= '}';

        print($json);
    }

    function get_doctor_schedule() {
        $data = (new Database())->select('appointment', 'doctor=' . get('doctor_id'));

        $json = '';
        $json .= '{"data":';
        $json .= json_encode($data);
        $json .= '}';

        print($json);
    }

    function doctorlist() {
        $json = '';
        $json .= '{"data":';
        $json .= json_encode((new Database())->select('users', 'level=1'));
        $json .= '}';

        print($json);
    }

    function request_doctor() {
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

            print('success');
        } else {
            print('exists');
        }
    }

    function get_my_doctor() {
        $query_statement = '
        SELECT user.fullname AS fullname
        FROM doctor_patient_relation AS dpr
        JOIN users AS user 
        ON user.id = dpr.doctor 
        WHERE dpr.patient = ' . get('id') . '
        ';

        $data = (new Database())->query($query_statement);

        $json = '';
        $json .= '{"data":';
        $json .= json_encode($data);
        $json .= '}';

        print($json);
    }

    function appointment() {
        $get_doctor = (new Database())->select('users', 'fullname="' . post('doctor') . '"');
        $get_patient = (new Database())->select('users', 'id=' . post('patient'));

        $doctor_id = $get_doctor[0]['id'];
        $date = post('date');
        $time = date('h:i a', strtotime(post('time')));
        $patient = post('patient');

        $availability = (new Database())->select('appointment', 
        'doctor=' . $doctor_id . ' AND date="' . $date . '" 
        AND time="' . $time . '" AND (status="pending" OR status="approve")');

        if(sizeof($availability) <= 0) {
           $data = array(
                'patient' => $get_patient[0]['id'],
                'patient_name' => $get_patient[0]['fullname'],
                'doctor' => $doctor_id,
                'doctor_name' => post('doctor'),
                'date' => $date,
                'time' => $time
           ); 
           
           (new Database())->insert('appointment', $data);

           print('success');
        } else {
            print('notavailable');
        }
    }
}