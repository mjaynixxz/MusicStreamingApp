<?php
include('includes/config.php');

include('includes/Classes/Account.php');
include('includes/Classes/Constants.php');
$account = new Account($connection);

include('includes/handlers/register-handler.php');
include('includes/handlers/login-handler.php');

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];

    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register.css">
    <title>Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>


    <?php
    if(isset($_POST['registerUser'])) {
        echo "<script>
            $(document).ready(function() {
                $('#loginForm').hide();
                $('#registerForm').show();
            });
            </script>";
    } else {
        echo "<script>
                $(document).ready(function() {
                    $('#loginForm').show();
                    $('#registerForm').hide();
                });
                </script>";
    }

    ?>

</head>

<body>
    <div id="background">
        <div id="loginContainer">
            <div id="loginText">
                <h1>Get great music right now.</h1>
                <h2>Listen to loads for free</h2>
                <ul>
                    <li>Discover music you love </li>
                    <li>Create your own playlist</li>
                    <li>Follow artist to keep up-to-date</li>
                </ul>
            </div>

            <div id="inputContainer">

                <form id="loginForm" action="register.php" method="post">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Username</label>
                        <input id="loginUsername" name="loginUsername" type="text"
                            value="<?php getInputValue('loginUsername') ?>" id="loginUsername" placeholder="Username"
                            required>
                    </p>

                    <p>
                        <label for="loginPassword">Password</label>
                        <input id="loginPassword" name="loginPassword" type="password"
                            value="<?php getInputValue('loginPassword') ?>" required>

                    </p>


                    <button type="submit" name="loginSubmit">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account? <strong>Sign Up here.</strong></span>
                    </div>

                </form>
                <form id="registerForm" action="register.php" method="post">
                    <h2>Register to your account</h2>

                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                        <label for="fname">First Name</label>
                        <input id="fname" name="fname" type="text" value="<?php getInputValue('fname') ?>"
                            placeholder="John" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="lname">Last Name</label>
                        <input id="lname" name="lname" type="text" value="<?php getInputValue('lname') ?>"
                            placeholder="Doe" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                        <label for="registerUsername">Username</label>
                        <input id="registerUsername" name="username" value="<?php getInputValue('username') ?>"
                            type="text" placeholder="Username" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="<?php getInputValue('email') ?>"
                            placeholder="Johndoe@gmail.com" required>
                    </p>

                    <p>
                        <label for="email2">Confirm Email</label>
                        <input id="email2" name="email2" type="email" value="<?php getInputValue('email2') ?>"
                            placeholder="Johndoe@gmail.com" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordCharacters) ?>
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required>

                    </p>

                    <p>
                        <label for="password2">Confirm password</label>
                        <input id="password2" name="password2" type="password" required>

                    </p>

                    <button type="submit" name="registerUser">Register</button>
                    <div class="hasAccountText">
                        <span id="hideRegister">Have an account? <strong>Login here.</strong></span>
                    </div>
                </form>

            </div>

        </div>
    </div>
</body>

</html>