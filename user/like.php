<?php
session_start();

include "../connection/config.php";
global $conn;

$post_id = trim($_GET["postId"]);
$user_id = $_SESSION["id"];

$sql = "SELECT * FROM post_interactions WHERE post_id = ? AND user_id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('ii', $post_id, $user_id);
    if ($stmt->execute())
    {
        $result = $stmt->get_result();
        $stmt->close();

        if ($row = $result->fetch_assoc())
        {
            if (checkLike($post_id, $user_id)) {
                unlike($post_id, $user_id);
            } else {
                like($post_id, $user_id);
            }
        }
        else
        {
            createInteraction($post_id, $user_id);
            like($post_id, $user_id);
        }
    }
}

header("location: ../index.php");

function createInteraction($post_id, $user_id) : void
{
    global $conn;
    $sql = "INSERT INTO post_interactions (post_id, user_id) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ii', $post_id, $user_id);
        if ($stmt->execute()) {
            $stmt->close();
        }
    }
}

function like($post_id, $user_id) : void
{
    global $conn;
    $sql = "UPDATE post_interactions SET liked = true WHERE post_id = ? AND user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ii', $post_id, $user_id);
        if ($stmt->execute()) {
            $stmt->close();
            updateLikeCount($post_id, 1);
        }
    }
}

function unlike($post_id, $user_id) : void
{
    global $conn;
    $sql = "UPDATE post_interactions SET liked = false WHERE post_id = ? AND user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ii', $post_id, $user_id);
        if ($stmt->execute()) {
            $stmt->close();
            updateLikeCount($post_id, -1);
        }
    }

}

function checkLike($post_id, $user_id)
{
    global $conn;
    $sql = "SELECT liked FROM post_interactions WHERE post_id = ? AND user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ii', $post_id, $user_id);
        if ($stmt->execute()) {
            $stmt->bind_result($liked);
            $stmt->fetch();
            $stmt->close();
            return $liked;
        }
        else {
            echo "Something went wrong, please try again later";
        }
    }
    echo "Something went wrong, please try again later";
}

function updateLikeCount($post_id, $like_value)
{
    global $conn;
    $sql = "UPDATE post SET like_count = like_count + $like_value WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $post_id);
        if ($stmt->execute()) {
            $stmt->close();
        }
    }
}

