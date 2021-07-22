<?php
     function isLoggedIn()
    {
        if(isset($_SESSION['id']) || isset($_SESSION['aId'])){
            return true;
        }else{
            return false;
        }
    }