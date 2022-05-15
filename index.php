<?php
session_start();

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("location: user/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home - Niggod</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="container-fluid" id="header_container">
        <div class="row">
            <div class="col-3" id="header_text">
                <h1>NIGGOD</h1>
            </div>
            <div class="col-9" id="header_img">
                <a href="index.php"> <img
                            src="https://cdn.discordapp.com/attachments/943544446551752746/973269731534577694/unknown.png"
                            alt="home" id="header_home_img"></a>
                <img src="https://cdn.discordapp.com/attachments/943544446551752746/973272366648021052/unknown.png"
                     alt="profile" id="header_profile_img">
                <a href="user/logout.php" id="login-button">Log Out</a>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container" id="main_container">
        <div class="post-window">
            <form>
                <div class="row">
                    <div class="col">
                        <label for="post-input">What's on your mind?</label>
                        <input type="text" name="post-input" id="post-input">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <a><img src="https://media.discordapp.net/attachments/975385808255201300/975385832355663982/unknown.png" style="width: 50px; height: 50px"></a>
                    </div>
                    <div class="col-4">
                        <input type="submit" value="Post" id="post-submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<footer>
    <div class="container">
        <div class="row">
            <div class="col" id="footer_links">
                <a href="https://discord.gg/qAtGbg4jfp"> <img id="discordLogo"
                                                              src="https://cdn.discordapp.com/attachments/943544446551752746/973245509173145610/unknown.png"
                                                              alt="discord" style="width: 50px; height: 50px"></a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>