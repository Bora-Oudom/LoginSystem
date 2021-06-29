<?php
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            //print_r($this->getUrl());

            $url = $this->getUrl();

            //look in'controllers' for first value, and ucwords will be capitalize first letter
            if($url){
                if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){

                // If exists, set a new controller
                $this->currentController = ucwords($url[0]);

                // Unset 0 Index
                unset($url[0]);
                }
            }
            

            //require the controller class
            require_once '../app/controllers/'. $this->currentController . '.php';

            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check for second part of url
            if(isset($url[1])){
             // Check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])){
                  $this->currentMethod = $url[1];
                  // Unset 1 index
                  unset($url[1]);
                }
            }


            // Get params
            $this->params = $url ? array_values($url) : [];

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
         }

        public function getUrl()
        {
            if (isset($_GET['url'])){

                //to get rid of / in url
                $url = rtrim($_GET['url'], '/');

                //to filter variable string or number in the url
                $url = filter_var($url, FILTER_SANITIZE_URL);

                //break the url into an array 
                $url = explode('/', $url);
                return $url;
            }
        }
    }