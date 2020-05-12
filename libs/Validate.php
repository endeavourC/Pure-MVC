<?php

class Validate {

    public function __construct(){

    }

    public function sanitize($data){
        // $data = trim($data);
        // $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    public function minlength($data, $arg){

        if(strlen($data) < $arg){
            return "Your string can only be $arg long.";
        }

    }
    public function maxlength($data, $arg){

        if(strlen($data) > $arg){
            return "Your string can only be $arg long.";
        }

    }
    public function digit($data){

        if(!is_numeric($data)){
            return "Your field must to be a digital.";
        }

    }

    public function string($data){
        if (!preg_match("/^[a-zA-Z ]*$/",$data)) {
            return  "Only letters and white space allowed";
          }
    }
    public function email($data){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           return "Email is invalid.";
          }
    }

    public function url($data){
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
           return  "Invalid URL";
          }
    }

    public function __call($name, $arguments){
        throw new Exception("$name does not exist inside of class " .__CLASS__);
    }

}