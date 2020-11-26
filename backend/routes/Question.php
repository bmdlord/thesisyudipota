<?php
use backend\core\Database;

class Question {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
        }
    }

    function get() {
        $query_statement = '
        SELECT DISTINCT title FROM questions WHERE userid=' . get_session('userid') . ' 
        ';

        set_data((new Database())->query($query_statement));
        if(get_session('level') == 1)
            return panel_view('question'); 
    }

    function post() {
        switch(get('seq')) {
            case 'create':
                for($i = 0; $i < count(post('question')); $i++) {
                    $data = array(
                        'userid' => post('userid'),
                        'title' => post('title'),
                        'question' => post('question')[$i],
                        'a' => post('optionsA')[$i],
                        'b' => post('optionsB')[$i],
                        'c' => post('optionsC')[$i],
                        'd' => post('optionsD')[$i],
                        'answer' => post('answer')[$i]
                    );

                    (new Database())->insert('questions', $data);
                }
                address('question/create?status=success');
                break;
        }
    }

    function create() {
        if(@get_session('level') != 1) {
            address('panel');
            exit();
        }

        return panel_view('create_question');
    }

    function viewquestion() {
        $condition = 'userid=' . get_session('userid') . ' AND title = "' . get('title') . '"';
        set_data((new Database())->select('questions', $condition));
        return panel_view('questiondetails');
    }

    function assignpatient() {
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
        
        return panel_view('assignpatient');
    }

    function assign() {
        $condition = 'patient=' . get('u') . ' AND task = "' . get('title') . '"';
        $isExists = (new Database())->select('task', $condition);

        if(sizeof($isExists) > 0) {
            $data = array(
                'status' => 'not validate'
            );

            (new Database())->update('task', $data, $condition);

            address('question/assignpatient?question=' . get('title') . '&status=reassign');
        } else {
            $get_total = (new Database())->query('SELECT COUNT(id) AS count_question FROM questions WHERE title="' . get('title') . '";');
            $total = 0;
            
            foreach($get_total as $key) {
                $total = $key['count_question'];
            }

            $data = array(
                'patient' => get('u'),
                'task' => get('title'),
                'total' => $total
            );

            (new Database())->insert('task', $data);
            address('question/assignpatient?question=' . get('title') . '&status=success');
        }
    }

    function patienttask() {
	    $id = (@get('id')) ? get('id') : get_session('userid');
        $condition = 'patient = ' . $id;
        set_data((new Database())->select('task', $condition));
        return panel_view('tasklist');
    }

    function takequiz() {
        set_data((new Database())->select('questions', 'title="' . get('question') . '"'));
        return panel_view('takequiz');
    }

    function donequiz() {
        $task = get('title');
        $id = get('id');
        $user_answer = post('user_answer');
        $answer = post('answer');
        
        $score = 0;

        for($i = 0; $i < sizeof($user_answer); $i++) {
            if($user_answer[$i] == $answer[$i]) {
                $score += 1;
            }
        }

        $data = array(
            'status' => 'taken',
            'score' => $score,
            'month' => date('M')
        );

        (new Database())->update('task', $data, 'id=' . $id . ' AND task="' . $task . '"');

        address('question/patienttask?status=done');
    }
}
