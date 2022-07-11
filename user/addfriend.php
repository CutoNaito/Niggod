<?php
session_start();
include "../connection/config.php";

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
            $user1 = $row["user1"];
            $user2 = $row["user2"];
            if ($row["user1_confirm"] == "1" && $row["user2_confirm"] == "1") {
                $sql = "DELETE FROM friend WHERE user1 = ? AND user2 = ?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param('ii', $user1, $user2);
                    if ($stmt->execute()) {
                        $stmt->close();
                        header("location: ../profile.php?username=$username_var");
                    } else {
                        echo "Something went wrong, please try again later";
                    }
                }
            }
            if ($user1 == $_SESSION["id"]){
                if ($row["user1_confirm"] != "1" && $row["user2_confirm"] == "1") {
                    $sql = "UPDATE friend SET user1_confirm = 1 WHERE user1 = ? AND user2 = ?";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param('ii', $user1, $user2);
                        if ($stmt->execute()) {
                            $stmt->close();
                            header("location: ../profile.php?username=$username_var");
                        } else {
                            echo "Something went wrong, please try again later";
                        }
                    }
                }
            } else {
                if ($row["user1_confirm"] == "1" && $row["user2_confirm"] != "1") {
                    $sql = "UPDATE friend SET user2_confirm = 1 WHERE user1 = ? AND user2 = ?";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param('ii', $user1, $user2);
                        if ($stmt->execute()) {
                            $stmt->close();
                            header("location: ../profile.php?username=$username_var");
                        } else {
                            echo "Something went wrong, please try again later";
                        }
                    }
                }
            }
        } else {
            $sql = "INSERT INTO friend (user1, user2, user1_confirm, user2_confirm) values (?, ?, 1, 0)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('ii', $_SESSION["id"], $id);
                if ($stmt->execute()) {
                    $stmt->close();
                    header("location: ../profile.php?username=$username_var");
                } else {
                    echo "Something went wrong, please try again later";
                }
            }
        }
    }
}
?>