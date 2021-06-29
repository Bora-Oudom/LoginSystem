<?php
    class User {
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }

        public function login($username, $password)
        {
            //prepare statement
           $this->db->query("SELECT * FROM users WHERE username = :username");

           //bind the value with variable 
           $this->db->bind(':username', $username);

           //to return a single row 
           $row = $this->db->single();

           //assign variable and get the hashed password in the database
           $hashedPassword = $row->password;
        
           //to check the password is match with the hash password or not
           if(password_verify($password, $hashedPassword)){
               return $row;
           }else{
               return false;
           }
        }

        //find user by email
        public function findUserByEmail($email) {
            //Prepared statement
            $this->db->query('SELECT * FROM users WHERE email = :email');
    
            //Email param will be binded with the email variable
            $this->db->bind(':email', $email);
    
            //Check if email is already registered
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function register($data)
        {
            //prepare statement
            $this->db->query("INSERT INTO users(username, email, password)
                VALUES(:username, :email, :password)");
            
            //bind values
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            //exeute the function
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }