<?php
function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
session_start();

include "../connection/config.php";
$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
$newfilename = "";
$files = scandir("../images");
if(array_search(basename($_FILES["fileInput"]["name"]), $files)){
    $newfilename = "niggod_".generateRandomString().".jpg";
    move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_dir . $newfilename);
}
$uploadOk = 1;
move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file);
$target = explode('/images/', $target_file);
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["username"]);
if($stmt->execute()) {
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $user_id = $row["id"];
    }
    if ($_POST["post-input"] != "" || $target[1] != "") {
        $sql = "INSERT INTO post (text_content, image_content, user_id) values (?, ?, ?)";
        $stmt->prepare($sql);
        $stmt->bind_param("ssi", $_POST["post-input"], $target[1], $user_id);
        if ($stmt->execute()) {
            header("location: ../index.php");
        } else {
            echo "Something went wrong.";
        }
    } else {
        header("location: ../index.php");
    }
} else {
    echo "Something went wrong.";
}
?>