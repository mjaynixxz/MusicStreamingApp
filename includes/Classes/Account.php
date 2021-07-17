<?php

//Class for account validation
    class Account
    {
        private $connection;
        private $errorArray;
        
        public function __construct($connection) {
            $this->connection = $connection;
            $this->errorArray = array();
        }

        public function loginUser($un, $pw) {
            $pw = md5($pw);
            $query = mysqli_query($this->connection, "SELECT * FROM users WHERE username='$un' AND password='$pw'");
            if (mysqli_num_rows($query) == 1) {
                return true;
            }
            else {
                array_push($this->errorArray, Constants::$loginFailed);
            }

        }

        public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
            $this->validateFn($fn);
            $this->validateLn($ln);
            $this->validateUsername($un);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)) {
                //insert into db
                return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
            }
            else {
                return false;
            }

        }

        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function insertUserDetails($fn, $ln, $un, $em, $pw) {
            $encryptedPw = md5($pw);
            $date = date("Y-m-d");
            $profile_pic = "assets/images/profilePicture/profilePic.png";


            $result = mysqli_query($this->connection, "INSERT INTO users VALUES (null, '$fn', '$ln', '$un', '$em', '$encryptedPw', '$date', '$profile_pic')");
            
            return $result;

        }

        private function validateUsername($un) {
            if(strlen($un) > 25 || strlen($un) < 5 ) {
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }

            $checkUsername = mysqli_query($this->connection, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsername) != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
        }

        private function validateFn($fn) {
            if(strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }

        private function validateLn($ln) {
            if(strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
        }

        private function validateEmails($em, $em2) {
            if($em != $em2) {
                array_push($this->errorArray, Constants::$emailsDoNotMatch);
                return;
            }

            if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
            }

            //TODO: Check if email already exist.
            $checkEmail = mysqli_query($this->connection, "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmail) != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
        }

        private function validatePasswords($pw, $pw2) {
            if($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }

            if(strlen($pw) > 30 || strlen($pw) < 5) {
                array_push($this->array, Constants::$usernameCharacters);
                return;
            }
        }

    }
    

?>