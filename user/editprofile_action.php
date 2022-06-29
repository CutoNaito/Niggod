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
$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
$newfilename = "";
$files = scandir("../img");
if(array_search(basename($_FILES["fileInput"]["name"]), $files)){
    $newfilename = "niggod_".generateRandomString().".jpg";
    move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_dir . $newfilename);
}
$uploadOk = 1;
move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file);
$target = explode('/img/', $target_file);

$sql = "UPDATE users SET username = ?, bio = ?, profile_picture = ? WHERE id = ?";
if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("sssi", $username, $bio, $profile_picture, $id);
    $username = $_POST['username_update'];
    $bio = $_POST['bio_update'];
    $profile_picture = $target[1];
    $id = $_SESSION['id'];
    if($stmt->execute()){
        $_SESSION["username"] = $username;
        header("location: ../profile.php?username=$username");
    } else{
        echo "Something went wrong.";
    }
    $stmt->close();
}
?>