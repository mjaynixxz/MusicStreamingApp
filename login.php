<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <div id="inputContainer">
        <form id="loginForm" action="register.php" method="post">
            <h2>Login to your account</h2>
            <p>
                <label for="loginUsername">Username: </label>
                <input id="loginUsername" name="loginUsername" type="text" id="loginUsername" placeholder="Username"
                    required>
            </p>

            <p>
                <label for="loginPassword">Password: </label>
                <input id="loginPassword" name="loginPassword" type="password" required>

            </p>

            <button type="submit" name="loginSubmit">LOG IN</button>
        </form>
    </div>
</body>

</html>