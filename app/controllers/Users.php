<?php
    class Users extends Controller{
        public function __construct() {
            $this->userModel = $this->model('User');
        }


        public function signup()
        {
            $data = [
                'title' => 'Signup page',
                'username' => '',
                'email' => '',
                'password' => '',
                'repassword' => '',
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'repasswordError' => ''
            ];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize Post data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'repassword' => trim($_POST['repassword']),
                    'usernameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'repasswordError' => ''
                ];
                //allow only character from A-Z and 0-9
                $nameValidation = "/^[a-zA-Z0-9]*$/";

                //password must be at least 8 
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
                
                //validata username
                if(empty($data['username'])){
                    $data['usernameError'] = 'Please enter username.';
                }elseif(!preg_match($nameValidation, $data['username'])){
                    $data['usernameError'] = 'Username must be latters and number.';
                }

                //validate email
                if(empty($data['email'])){
                    $data['emailError'] = 'Please enter email';
                }elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = 'Email is not correct';
                }else{
                    //check for email exist
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['emailError'] = 'Email already exist.' . 'Do you want to login?';
                    }
                }

                //validate password
                if(empty($data['password'])){
                    $data['passwordError'] = 'please enter password.';
                }elseif (strlen($data['password'])<6) {
                    $data['passwordError'] = 'Password must be 8 characters.';
                }
                // elseif(preg_match($passwordValidation, $data['password'])){
                //     $data['passwordError'] = 'Password must have at least one numebr.';
                // }


                //validate repassword
                if(empty($data['repassword'])){
                    $data['repasswordError'] = 'please enter Re-Password.';
                }elseif ($data['password'] != $data['repassword']) {
                    $data['repasswordError'] = 'Passwords do not match, please try again.';
                }

                //make sure all errors are emty
                if(empty($data['usernameError']) && empty($data['emailError']) && 
                    empty($data['passwordError']) && empty($data['repasswordError'])){

                        //hash password
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                        //signup user from model function 
                        if($this->userModel->register($data)){

                            //redirect to home page 
                            header('location: ' . URLROOT . '/users/login');
                        }else{
                            die('Something went wrong');
                        }
                    } 
                }

            $this->view('users/signup', $data);
        }


        public function login()
        {
            $data = [
                'title' => 'Login page',
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize Post data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'usernameError' => '',
                    'passwordError' => ''
                ];

                //validate username 
                if(empty($data['username'])){
                    $data['usernameError'] = 'Pleace enter username.';
                }

                //validate password
                if(empty($data['password'])){
                        $data['passwordError'] = 'Pleace enter password.';
                    }
                
                //check if all the error are emty
                if(empty($data['usernameError']) && empty($data['passwordError'])){
                    $loggedInUser = $this->userModel->userLogin($data['username'], $data['password']);
                    
                    //to check is the user is set
                    if($loggedInUser){
                        $this->createUserSession($loggedInUser);
                    }else {
                        $data['passwordError'] = 'Password or username is incorrect. Please try again.';
    
                        $this->view('users/login', $data);
                    }
                }
            }else{
                $data = [
                    'username' => '',
                    'password' => '',
                    'usernameError' => '',
                    'passwordError' => ''
                ];
            }
            
            $this->view('users/login', $data);
        }


        public function createUserSession($user) {
            $_SESSION['id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            
            header('location:' . URLROOT . '/pages/index');
        }
        

        public function logout() {
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            header('location:' . URLROOT . '/users/login');
        }


        public function editProfile()
        {
            $data = [
                'title' => 'Edit profile page',
                'username' => '',
                'email' => '',
                'usernameError' => '',
                'emailError' => ''
            ];
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize Post data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'usernameError' => '',
                    'emailError' => ''
                ];

                $nameValidation = "/^[a-zA-Z0-9]*$/";

                //validate username
                if(empty($data['username'])){
                    $data['usernameError'] = 'Please enter your new username';
                }elseif(!preg_match($nameValidation, $data['username'])){
                    $data['usernameError'] = 'Username must be latters and number.';
                }
                else{
                    //check for username exist
                    if($this->userModel->findUserByUsername($data['username'])){
                        $data['usernameError'] = 'Username already exist.' . 'Do you want to login?';
                    }
                }

                //validate email
                if(empty($data['email'])){
                    $data['emailError'] = 'Please enter your new email';
                }elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = 'Email is not correct';
                }else{
                    //check for email exist
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['emailError'] = 'Email already exist.' . 'Try a new one';
                    }
                }
                if(empty($data['usernameError']) && empty($data['emailError'])){         
                         $this->userModel->updateProfile($data);
                         header('location:' . URLROOT . '/users/login');
                    } 
            }
            $this->view('users/editprofile',$data);
        }
        
    
        public function changePassword()
        {
            $data = [
                'title' => 'Change Password page',
                'password' => '',
                'newPassword' => '',
                'repassword' => '',
                'passwordError' => '',
                'newPasswordError' => '',
                'repasswordError' => ''
            ];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize Post data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'password' => trim($_POST['password']),
                    'newPassword' => trim($_POST['newPassword']),
                    'repassword' => trim($_POST['repassword']),
                    'passwordError' => '',
                    'newPasswordError' => '',
                    'repasswordError' => ''
                ];


                //validate password
                if(empty($data['password'])){
                    $data['passwordError'] = 'please enter password.';
                }elseif(!$this->userModel->fetchPassword($data['password'])){
                    $data['passwordError'] = 'Password is not correct.';
                }

                //validate new password
                if(empty($data['newPassword'])){
                    $data['newPasswordError'] = 'please enter password.';
                }elseif (strlen($data['newPassword'])<6) {
                    $data['newPasswordError'] = 'Password must be 8 characters.';
                }
                // elseif(preg_match($passwordValidation, $data['password'])){
                //     $data['passwordError'] = 'Password must have at least one numebr.';
                // }


                //validate repassword
                if(empty($data['repassword'])){
                    $data['repasswordError'] = 'please enter Re-Password.';
                }elseif ($data['newPassword'] != $data['repassword']) {
                    $data['repasswordError'] = 'Passwords do not match, please try again.';
                }

                //check if all the error are emty
                if(empty($data['passwordError']) && empty($data['newPasswordError']) && empty($data['repasswordError'])){

                     //hash password
                    $data['newPassword'] = password_hash($data['newPassword'], PASSWORD_DEFAULT);

                    //update password from model function 
                    if($this->userModel->updatePassword($data)){

                    //redirect to home page 
                    header('location: ' . URLROOT . '/users/login');
                    }else{
                    die('Something went wrong');
                    }
                }
            }
           $this->view('users/changepassword', $data);
        }


        public function profile()
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize Post data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                    $this->userModel->deleteAcc();
                header('location:' . URLROOT . '/users/login');
            }
            $this->view('users/profile');
        }


       
}
