<?php
include("connection/config.php");
$uservar = $_GET["username"];
$sql = "SELECT username FROM users WHERE username LIKE '%$uservar%'";
if ($stmt = $conn->prepare($sql)) {
    if ($stmt = $conn->prepare($sql)) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
        }
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
            <div class="col" id="searchbar_div">
                <form action="search.php" method="get">
                    <input type="text" name="username" id="searchbar_input" size="80">
                    <input type="submit" value="Search">
                </form>
            </div>
            <div class="col-3" id="header_img">
                <a href="index.php"> <img
                            src="https://cdn.discordapp.com/attachments/943544446551752746/973269731534577694/unknown.png"
                            alt="home" id="header_home_img"></a>
                <a href="profile.php?username=<?php echo $_SESSION["username"] ?>"> <img
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
                <?php
                if (!empty($result)) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <fieldset id="post-fieldset">
                                <a href="profile.php?username=<?php echo $row["username"]?>"><?php echo $row["username"] ?></a>
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