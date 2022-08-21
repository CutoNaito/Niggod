<?php
session_start();

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("location: welcome.php");
    exit;
}
include("connection/config.php");
$sql = "SELECT profile_picture, text_content, image_content, username, posted_at FROM post INNER JOIN users ON users.id = post.user_id ORDER BY posted_at DESC";
if ($stmt = $conn->prepare($sql)) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();
    }
}

function checkIfFriend($username){
    global $conn;
    $sql = "SELECT id FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $username);
        if ($stmt->execute()) {
            $result_func = $stmt->get_result();
            if($row_func = $result_func->fetch_assoc()){
                $user_id = $row_func["id"];
            }
        }
    }
    $sql = "SELECT * FROM friend WHERE user1 = ? AND user2 = ? OR user1 = ? AND user2 = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('iiii', $_SESSION["id"], $user_id, $user_id, $_SESSION["id"]);
        if ($stmt->execute()) {
            $result_func = $stmt->get_result();
            if($row_func = $result_func->fetch_assoc()){
                if($row_func["user1_confirm"] == "1" && $row_func["user2_confirm"] == "1"){
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home - Niggod</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="script/index-script.ts"></script>
    <link rel="icon" href="img/NiggodRat.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
    <?php include("header.php"); ?>
    <main>
        <div class="container">
            <div class="container" style="width: 50%;">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <form action="user/post.php" method="post" enctype="multipart/form-data">
                            <div class="row text-center">
                                <h2 class="card-title">What's on your mind?</h2>
                            </div>
                            <div class="col">
                                <div class="mb-3 mt-3">
                                    <textarea class="form-control" rows="5" id="comment" name="post-input"></textarea>
                                </div>
                                <div style="overflow: hidden; height: 0">
                                    <input type="file" id="fileInput" name="fileInput">
                                </div>
                                <button class="btn btn-outline-light" type="button" id="chooseImg" onclick="chooseFile()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit" id="post-submit">Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if (!empty($result)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if(checkIfFriend($row["username"]) || $row["username"] == $_SESSION["username"]) {

                        
            ?>
                        <div class="container position-relative" style="width: 50%;">
                            <a href="profile.php?username=<?php echo $row["username"] ?>">
                                <img class="position-absolute top-0 end-100 rounded" style="height:64px;" src="img/<?php echo $row["profile_picture"] ?>" alt="Profile picture"> <!-- absolute profile picture -->
                            </a>
                            <div class="card bg-dark text-white mt-2 mb-2">
                                <div class="card-body">
                                    <a href="profile.php?username=<?php echo $row["username"] ?>" class="text-decoration-none text-white">
                                        <h2 class="card-title text-left"><?php echo $row["username"] ?></h2>
                                    </a>
                                    <p class="card-text"><?php echo $row["text_content"] ?></p>
                                </div>
                                <?php if($row["image_content"] != "") { ?>
                                <img src="images/<?php echo $row["image_content"] ?>">
                                <?php } ?>
                                <div class="card-footer text-muted text-center">
                                    <p class="marginZero">Posted at: <?php echo $row["posted_at"] ?></p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
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