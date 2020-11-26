<?php
use backend\core\Database;

class Appointment {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
        }
    }

    function get() {
        return panel_view('setappointment');
    }
    
    function doctorappointment() {
    	set_data(
    		array(
    			'patient' => (new Database())->select('users', 'id=' . get('patient')),
    			'doctor' => (new Database())->select('users', 'id=' . get('doctor'))
    		)
    	);
    	
    	return panel_view('setappointmentdoctor');
    }

	function postdoctor() {
        $availability = (new Database())->select('appointment', 
        'doctor=' . post('doctor_id') . ' AND date="' . post('date') . '" 
        AND time="' . post('time') . '" AND (status="pending" OR status="approve")');

        if(sizeof($availability) <= 0) {
           $data = array(
                'patient' => post('patient_id'),
                'patient_name' => post('patient_name'),
                'doctor' => post('doctor_id'),
                'doctor_name' => post('doctor_name'),
                'date' => post('date'),
                'time' => post('time'),
                'status' => 'approve'
           ); 

           (new Database())->insert('appointment', $data);

           address('appointment/doctorappointment?patient=' . post('patient_id') . '&doctor=' . post('doctor_id') . '&status=success');
        } else {
            address('appointment/doctorappointment?patient=' . post('patient_id') . '&doctor=' . post('doctor_id') . '&status=notavailable');
        }
    }

    function post() {
        $availability = (new Database())->select('appointment', 
        'doctor=' . post('doctor_id') . ' AND date="' . post('date') . '" 
        AND time="' . post('time') . '" AND (status="pending" OR status="approve")');

        if(sizeof($availability) <= 0) {
           $data = array(
                'patient' => post('patient_id'),
                'patient_name' => post('patient_name'),
                'doctor' => post('doctor_id'),
                'doctor_name' => post('doctor_name'),
                'date' => post('date'),
                'time' => post('time')
           ); 

           (new Database())->insert('appointment', $data);

           address('appointment?doctor=' . post('doctor_id') . '&name=' . post('doctor_name') . '&status=success');
        } else {
            address('appointment?doctor=' . post('doctor_id') . '&name=' . post('doctor_name') . '&status=notavailable');
        }
    }
}
