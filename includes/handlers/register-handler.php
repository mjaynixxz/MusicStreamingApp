<?php

function sanitizeFormPassword($input) {
    $input = strip_tags($input);
    return $input;
    
}

function sanitizeFormUsername($input) {
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    return $input;
    
}

function sanitizeFormStrings($input) {
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    $input = ucfirst(strtolower($input));
    return $input;
}




if(isset($_POST['registerUser'])) {
    $fname = sanitizeFormStrings($_POST['fname']);
    $lname = sanitizeFormStrings($_POST['lname']);
    $username = sanitizeFormUsername($_POST['username']);
    $email = sanitizeFormStrings($_POST['email']);
    $email2 = sanitizeFormStrings($_POST['email2']);

    $password = sanitizeFormPassword($_POST['password']);
    $password2 = sanitizeFormPassword($_POST['password2']);

    $wasSuccessful = $account->register($fname, $lname, $username, $email, $email2, $password, $password2);

    if($wasSuccessful) {
        $_SESSION['userLoggedIn'] = $username;
        header('Location: index.php');
    }
}


?>