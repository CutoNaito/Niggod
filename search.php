<?php
session_start();
include "connection/config.php";
$uservar = $_GET["username"];
$sql = "SELECT username, bio, profile_picture FROM users WHERE username LIKE '%$uservar%'";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home - Niggod</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="script/index-script.ts"></script>
    <link rel="icon" href="img/NiggodRat.ico">
    <link rel="stylesheet" href="css/card-prof-pics.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
    <?php include("header.php"); ?>
    <main>

        <div class="container py-4 py-xl-5">
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                <?php
                if (!empty($result)) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="profile-pic pic-radius pic-radius-p d-flex justify-content-center align-items-center d-inline-block mb-3">
                                            <img style="height:64px; width:64px;" src="img/<?php echo $row["profile_picture"] ?>" alt="Profile picture">
                                        </div>
                                        <h5 class="card-title"><?php echo $row["username"] ?></h5>
                                        <p class="card-text"><?php echo $row["bio"] ?></p>
                                        <a href="profile.php?username=<?php echo $row["username"] ?>" class="btn btn-secondary">View</a>
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
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>