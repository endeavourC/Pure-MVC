<?php

class Auth {

    public static function is_logged(){

        Session::init();
        $logged = $_SESSION['loggedIn'];
        if($logged == false) {
            session_destroy();
            header('Location:'.URL.'login');
            exit;
        }
    }
    public static function is_admin(){
        $role = $_SESSION['role'];
        if($role != "admin" && $role != "owner"){
            session_destroy();
            header('Location:'.URL.'login');
            exit;
        }
    }
   
}