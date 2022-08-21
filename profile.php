<?php
session_start();

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("location: welcome.php");
    exit;
}
include("connection/config.php");
$username_var = trim($_GET["username"]);
$sql = "SELECT id, username, created_at, profile_picture, bio FROM users WHERE username = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('s', $username_var);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $username, $date, $profile_picture, $bio);
        $stmt->fetch();
        $stmt->close();
    }
} else {
    echo "Something went wrong, please try again later";
}
$sql = "SELECT * FROM friend WHERE user1 = ? AND user2 = ? OR user1 = ? AND user2 = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('iiii', $_SESSION["id"], $id, $id, $_SESSION["id"]);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if ($row["user1_confirm"] == "1" && $row["user2_confirm"] == "1") {
                $friend_caption = "Unfriend";
            }
            if ($row["user1"] == $_SESSION["id"]) {
                if ($row["user1_confirm"] != "1" && $row["user2_confirm"] == "1") {
                    $friend_caption = "Accept Friend Request";
                } elseif ($row["user1_confirm"] == "1" && $row["user2_confirm"] != "1") {
                    $friend_caption = "Friend Request Sent";
                }
            } else {
                if ($row["user1_confirm"] == "1" && $row["user2_confirm"] != "1") {
                    $friend_caption = "Accept Friend Request";
                } elseif ($row["user1_confirm"] != "1" && $row["user2_confirm"] == "1") {
                    $friend_caption = "Friend Request Sent";
                }
            }
    } else {
        $friend_caption = "Add Friend";
    }
}
}
$sql = "SELECT * FROM post WHERE user_id = ? ORDER BY posted_at DESC";
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
    <link rel="icon" href="img/NiggodRat.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
<?php include("header.php"); ?>
<main>

    <div class="container">
        <?php if ($_GET["username"] == $_SESSION["username"]) { ?>
            <div class="card bg-dark text-white positionEditCard" style="width: 20%;">
                <div class="card-body">
                    <a href="user/editprofile.php">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">
                            Edit
                        </button>
                    </a>
                </div>
            </div>
        <?php } ?>
        <?php if ($_GET["username"] != $_SESSION["username"]) { ?>
        <div class="card bg-dark text-white positionEditCard" style="width: 20%;">
            <div class="card-body">
                <?php if ($friend_caption != "Friend Request Sent") { ?>
                <a href="user/addfriend.php?username=<?php echo $_GET["username"] ?>">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">
                        <?php echo $friend_caption ?>
                    </button>
                </a>
                <?php } else {
                echo $friend_caption;
                } ?>
            </div>
        </div>
        <?php } ?>
        <div class="container position-relative card-size">
            <img class="position-absolute positionPI rounded"
                 src="img/<?php echo $profile_picture ?>" alt="Profile picture"> <!-- absolute profile picture -->
            <div class="card bg-dark text-white mt-2 mb-5">
                <div class="card-body">
                    <h1 class="card-title"><?php echo $username ?></h1>
                    <p id="profile-register">Registered to Niggod: <?php echo $date ?></p>
                    <p id="bio"><?php echo $bio ?></p>
                </div>
            </div>
        </div>

        <?php
        if (!empty($result)) {
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        ?>
        <div class="container position-relative card-size">
            <a href="#">
                <img class="position-absolute positionPI rounded"
                     src="img/<?php echo $profile_picture ?>" alt="Profile picture">
                <!-- absolute profile picture -->
            </a>
            <div class="card bg-dark text-white mt-2 mb-2">
                <div class="card-body">
                    <a href="#" class="text-decoration-none text-white">
                        <h2 class="card-title"><?php echo $username ?></h2>
                    </a>
                    <p class="card-text"><?php echo $row["text_content"] ?></p>
                </div>
                <img src="images/<?php echo $row["image_content"] ?>">
                <div class="card-footer text-muted text-center">
                    <p class="marginZero">Posted at: <?php echo $row["posted_at"] ?></p>
                </div>
            </div>
        </div>
        <?php
        }
        } else {
        echo "0 results";
        }
        }
        ?>


    </div>
</main>
<?php include("footer.php"); ?>
</body>

</html>