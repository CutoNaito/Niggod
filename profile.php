<?php
session_start();

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("location: welcome.php");
    exit;
}
include("connection/config.php");
$sql = "SELECT id, username, created_at FROM users WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('i', $_SESSION["id"]);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $username, $date);
        $stmt->fetch();
        $stmt->close();
    }
} else {
    echo "Something went wrong, please try again later";
}
$sql = "SELECT * FROM post WHERE user_id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile - Niggod</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <div class="container">
        <div class="row">
            <div class="col">
                <h1><?php echo $username ?></h1>
                <p id="profile-register">Registered to Niggod: <?php echo $date ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                if (!empty($result)) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            ?>
                            <fieldset id="post-fieldset">
                                <p><?php echo $username ?></p>
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
