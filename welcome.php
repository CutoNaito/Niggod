<?php
session_start();

if (isset($_SESSION["logged"]) && $_SESSION["logged"] === true) {
    header("location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome - Niggod</title>
    <link rel="stylesheet" href="css/welcome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<header>
    <h1>Welcome to NIGGOD</h1>
</header>
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="user/login.php" id="log-welcome">Log In</a>
                <p>or</p>
                <a href="user/signup.php" id="sign-welcome">Sign Up</a>
            </div>
        </div>
    </div>
</main>
</body>
</html>