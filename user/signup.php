<?php
include("../connection/config.php");
$username = $password = $repeat_password = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(trim($_POST["username"]) !== ""){
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);

            if($stmt->execute()){
                $stmt->store_result();

                if($stmt->num_rows() == 1) {
                    echo "Username is taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Something went wrong.";
            }
            $stmt->close();
        }
    }
    if(trim($_POST["password"]) !== ""){
        $password = trim($_POST["password"]);
    }

    if(trim($_POST["repeat_password"]) !== ""){
        $repeat_password = trim($_POST["repeat_password"]);

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if($stmt->execute()){
                header("location: login.php");
            } else{
                echo "Something went wrong.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign Up - Niggod</title>
    <link rel="stylesheet" href="../css/styles.css">
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
                <a href="../index.php"> <img
                        src="https://cdn.discordapp.com/attachments/943544446551752746/973269731534577694/unknown.png"
                        alt="home" id="header_home_img"></a>
                <img src="https://cdn.discordapp.com/attachments/943544446551752746/973272366648021052/unknown.png"
                     alt="profile" id="header_profile_img">
                <a href="login.php" id="login-button">Log In</a>
                <a href="signup.php" id="signup-button">Sign Up</a>
            </div>
        </div>
    </div>
</header>
<main>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" id="login-card" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Signup</h2>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="username" name="username" class="form-control form-control-lg"/>
                                        <label class="form-label" for="email">Username</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg"/>
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" name="repeat_password" class="form-control form-control-lg"/>
                                        <label class="form-label" for="typePasswordX">Repeat Password</label>
                                    </div>

                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a>
                                    </p>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>
                                </form>

                            </div>

                            <div>
                                <p class="mb-0">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Log In</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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