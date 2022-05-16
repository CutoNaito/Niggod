<?php
session_start();

include "../connection/config.php";
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["username"]);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
        $user_id = $row["id"];
    }

    $sql = "INSERT INTO post (text_content, image_content, user_id) values (?, ?, ?)";
    $stmt->prepare($sql);
    $stmt->bind_param("ssi", $_POST["post-input"], $_POST["fileInput"], $user_id);
    if($stmt->execute()){
        header("location: ../index.php");
    } else{
        echo "Something went wrong.";
    }
} else{
    echo "Something went wrong.";
}
?>