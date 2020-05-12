<?php
/*
- Fill out the form
- Post to PHP
- Sanitize
- Validate
- Return data
- Write to Database

*/ 
class Form {

    private $currentItem = null;

    private $postData = array();

    private $val = array();

    private $error = array();

    public function __construct(){

        $this->val = new Validate();

    }

    public function post($field){
        $this->postData[$this->val->sanitize($field)] = $this->val->sanitize($_POST[$field]);
        $this->currentItem = $this->val->sanitize($field);

    }
    public function fetch($fieldName = false){

        if($fieldName){
            if(isset($this->postData[$fieldName]))
            return $this->postData[$fieldName];
            else
            return false;

        } else {

            return $this->postData;

        }

    }
    public function validate($type, $arg = null){

        if($arg == null)
        $error = $this->val->{$type}($this->postData[$this->currentItem]);
        else
        $error = $this->val->{$type}($this->postData[$this->currentItem], $arg);

        if($error){
            $this->error[$this->currentItem] = $error;
        }

    }

    public function get_errors(){
        return $this->error;
    }

}