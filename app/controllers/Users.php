<?php
    class Users extends Controller{
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function signup()
        {
            $data = [
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
                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                
                    //to check is the user is set
                    if($loggedInUser){
                        $this->createUserSession($loggedInUser);
                    }else{
                        $data['passwordError'] = 'Password or username is incorrecrt.' . 'Pleace try again.';
                        
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

    }