<?php
if(isset($_POST['loginSubmit'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    $result = $account->loginUser($username, $password);

    if($result) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }


}
?>