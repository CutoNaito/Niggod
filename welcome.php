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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome - Niggod</title>
    <link rel="icon" href="img/NiggodRat.ico">
    <link rel="stylesheet" href="css/welcome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .box {
            width: auto;
        }
        .box img {
            max-width: 100%;
            width: 100%;
            height: auto;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <header onmousedown='return false;' onselectstart='return false;'>
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo.png" alt="" width="180" height="70" class="d-inline-block align-text-top">
                </a>
                <!-- Heading -->
                <div>
                    <h1>Welcome to NIGGOD</h1>
                </div>
                <!-- Buttons for "sign up" and "log in" -->
                <div>
                    <a href="user/signup.php" class="btn btn-dark linkForButtons">
                        Sign Up
                    </a>
                    <a href="user/login.php" class="btn btn-secondary linkForButtons">
                        Log In
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="box">
            <img src="img/lsk.gif" alt="">
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>