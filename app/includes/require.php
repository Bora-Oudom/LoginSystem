<?php
    //require file in the libraries folder 
    require_once '../app/libraries/Database.php'; 
    require_once '../app/libraries/Core.php'; 
    require_once '../app/libraries/Controller.php'; 

    //require session helper
    require_once 'session_helper.php';

    //require the config file 
    require_once '../app/config/config.php';

    //instantiate core class
    $init = new Core();