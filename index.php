<?php
session_start();

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("location: welcome.php");
    exit;
}
include("connection/config.php");
$sql = "SELECT text_content, image_content, username FROM post INNER JOIN users ON users.id = post.user_id";
if ($stmt = $conn->prepare($sql)) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();
    }
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
    <script src="script/index-script.ts"></script>
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
                <a href="profile.php"> <img
                            src="https://cdn.discordapp.com/attachments/943544446551752746/973272366648021052/unknown.png"
                            alt="profile" id="header_profile_img"></a>
                <a href="user/logout.php" id="login-button">Log Out</a>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container" id="main_container">
        <div class="post-window">
            <form action="user/post.php" method="post">
                <div class="row">
                    <div class="col">
                        <label for="post-input">What's on your mind?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div style="overflow: hidden; height: 0">
                            <input type="file" id="fileInput" name="fileInput">
                        </div>
                        <input type="text" name="post-input" id="post-input">
                        <button type="button" id="chooseImg" onclick="chooseFile()"><img
                                    src="https://media.discordapp.net/attachments/975385808255201300/975385832355663982/unknown.png"
                                    style="width: 50px; height: 50px"></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <input type="submit" value="Post" id="post-submit">
                    </div>
                </div>
            </form>
        </div>
        <div class="post-select">
            <div class="row">
                <div class="col">
                    <?php
                    if (!empty($result)) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                ?>
                                <fieldset id="post-fieldset">
                                    <p><?php echo $row["username"] ?></p>
                                    <p><?php echo $row["text_content"] ?></p>
                                    <img src=<?php echo $row["image_content"] ?>>
                                </fieldset>
                                <?php
                            }
                        } else {
                            echo "0 results";
                        }
                    }
                    ?>
                </div>
            </div>
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