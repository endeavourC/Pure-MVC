<?php

class App {

    private $controller = null;

    private $url = null;

    
    function __construct(){

        // Sets the protected URL

        $this->getUrl();

        // Load default Controller Index if no URL is set

        if(empty($this->url[0])){

            $this->loadDefaultController();

            exit;

        } else {
                
            $this->loadExistingController();

            $this->callControllerMethod();

        }

    }

    /**
     * Fetches the $_GET from url
     */

    private function getUrl(){
        $url = isset( $_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->url = explode('/', $url);
        
    }
    /**
     * This loads if there is no GET parameter passed
     */
    private function loadDefaultController(){
        require 'controllers/index.php';
        $this->controller = new Index();
        $this->controller->index();
    }

    /**
     * Load an existing controller if there is a GET parameter
     */
    private function loadExistingController(){
        
        $file = 'controllers/'. $this->url[0] . '.php';
        if(file_exists($file)){
            require $file;
            $this->controller = new $this->url[0];
            $this->controller->loadModel($this->url[0]);
            if(count($this->url) == 1){
                $this->controller->index();
            }
        } else {
            $this->error();
            exit;
        }
        
    }
    /**
     * If a method is passed in the GET url parameter
     */
    private function callControllerMethod(){

        /**
         *  http://website.pl/controller/method/param/param/param
         *  url[0] = Controller
         *  url[1] = Method
         *  url[2] = Param
         *  url[3] = Param
         */ 

         if(count($this->url) >= 2) {
            if(!method_exists($this->controller, $this->url[1])) {
                $this->error();
                exit;
            }
            $params = $this->url;
            unset($params[0]); // removing controller
            unset($params[1]); // removing method
        
            call_user_func_array( array( $this->controller, $this->url[1] ) , $params );
        }

     
    }
    /**
     *  If there is no Controllers Set an Error 404
     */
    private function error(){
        require 'controllers/error.php';
        $this->controller = new ErrorMsg();
        $this->controller->index();
        return false;
    }

}