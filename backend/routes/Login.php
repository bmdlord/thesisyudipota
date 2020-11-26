<?php
use backend\core\Database;

class Login {
    function __construct() {
        session();

        if(@get_session('isLogin')) {
            address('panel');
        }
    }

    function get() {
        return authenticate_view('login');
    }

    function post() {
        $userEmail = post('email');
        $userPassword = post('password');

        $fetchData = (new Database())->select(
            'users',
            'email="' . $userEmail . '"'
        );

        if(@sizeof($fetchData) > 0) {
            foreach($fetchData as $field) {
                $dbUserId = $field['id'];
                $dbUserLevel = $field['level'];
                $dbPassword = $field['password'];
                $dbUserFullname = $field['fullname'];
            }

            if(password_verify($userPassword, $dbPassword)) {
                set_session('isLogin', true);
                set_session('userid', $dbUserId);
                set_session('level', $dbUserLevel);
                set_session('userfullname', $dbUserFullname);

                address('panel');
            } else {
                address('login?status=error');
            }
        } else {
            address('login?status=error');
        }
    }
}