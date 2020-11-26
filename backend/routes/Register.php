<?php
use backend\core\Database;

class Register {
    function __construct() {
        session();

        if(@get_session('isLogin')) {
            address('panel');
        }
    }

    function get() {
        return authenticate_view('register');
    }

    function post() {
        $data = array();

        $data['fullname'] = post('fullname');
        $data['address'] = post('address');
        $data['birthdate'] = post('birthdate');
        $data['email'] = post('email');
        $data['password'] = password_hash(post('password'), PASSWORD_DEFAULT, array('cost' => 12));
        $data['level'] = post('level');
        
        $emailExists = sizeof((new Database())->select('users', 'email="' . post('email') . '"'));
        
        if($emailExists <= 0) {
        	if(post('level') == 2) {
		        (new Database())->insert('users', $data);
		        address('register?type=patients&status=success');
		    } elseif(post('level') == 1) {
		       $tmp_image = $_FILES['image']['tmp_name'];
		       $image = $_FILES['image']['name']; 
		       $get_extension = explode($image, '.');
		       $get_extension = end($get_extension);
		       $newname = str_replace(" ", "_", post('fullname')) . '_' . date('mdYHis') . '.' . $get_extension;
		       $directory_target = getcwd() . '/media/' . basename($newname);
		        
		       $data['image'] = $newname;
		       $data['attainment'] = post('attainment');

		       if(move_uploaded_file($tmp_image, $directory_target)) {
		            (new Database())->insert('users', $data);
		            address('register?type=psychiatrists&status=success');
		       } else {
		            address('register?type=psychiatrists&status=fail');
		       }
		    } else {
		        address('login');
		    }
        } else {
        	address('register?type=psychiatrists&status=exists');
        }
    }
}
