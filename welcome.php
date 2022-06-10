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
    <link rel="icon" href="img/NiggodRat.ico">
    <link rel="stylesheet" href="css/welcome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        main {
            background-image: url("img/lsk.gif");
            background-size: cover;
            height: 1000px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="#">
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
    </main>
</body>
</html>