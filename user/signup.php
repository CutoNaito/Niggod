<?php
include("../connection/config.php");
$username = $password = $repeat_password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (trim($_POST["username"]) !== "") {
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows() == 1) {
                    echo "Username is taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Something went wrong.";
            }
            $stmt->close();
        }
    }
    if (trim($_POST["password"]) !== "") {
        $password = trim($_POST["password"]);
    }

    if (trim($_POST["repeat_password"]) !== "") {
        $repeat_password = trim($_POST["repeat_password"]);

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {
                header("location: login.php");
            } else {
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
    <link rel="icon" href="../img/NiggodRat.ico">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
    <header onmousedown='return false;' onselectstart='return false;'>
        <nav class="navbar bg-light shadow mb-5 rounded">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="#">
                    <img src="../img/logo.png" alt="" width="180" height="70" class="d-inline-block align-text-top">
                </a>
                <!-- Buttons for "sign up" and "log in" with buttons for "home" and "profile"-->
                <div>
                    <a href="../index.php" class="btn btn-light linkForButtons">
                        <img id="header_home_img" src="https://cdn.discordapp.com/attachments/943544446551752746/973269731534577694/unknown.png" alt="home">
                    </a>
                    <a href="#" class="btn btn-light linkForButtons">
                        <img id="header_profile_img" src="https://cdn.discordapp.com/attachments/943544446551752746/973272366648021052/unknown.png" alt="profile">
                    </a>
                    <a href="signup.php" class="btn btn-dark linkForButtons">
                        Sign Up
                    </a>
                    <a href="login.php" class="btn btn-secondary linkForButtons">
                        Log In
                    </a>
                </div>
            </div>
        </nav>
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
                                            <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                            <label class="form-label" for="email">Username</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" />
                                            <label class="form-label" for="typePasswordX">Password</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input type="password" id="typePasswordX" name="repeat_password" class="form-control form-control-lg" />
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
        <div class="container-fluid">
            <div class="row">
                <div class="col" id="footer_links">
                    <a href="https://discord.gg/qAtGbg4jfp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-discord" viewBox="0 0 16 16">
                            <path d="M13.545 2.907a13.227 13.227 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.19 12.19 0 0 0-3.658 0 8.258 8.258 0 0 0-.412-.833.051.051 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.041.041 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032c.001.014.01.028.021.037a13.276 13.276 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019c.308-.42.582-.863.818-1.329a.05.05 0 0 0-.01-.059.051.051 0 0 0-.018-.011 8.875 8.875 0 0 1-1.248-.595.05.05 0 0 1-.02-.066.051.051 0 0 1 .015-.019c.084-.063.168-.129.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.052.052 0 0 1 .053.007c.08.066.164.132.248.195a.051.051 0 0 1-.004.085 8.254 8.254 0 0 1-1.249.594.05.05 0 0 0-.03.03.052.052 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.235 13.235 0 0 0 4.001-2.02.049.049 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.034.034 0 0 0-.02-.019Zm-8.198 7.307c-.789 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612Zm5.316 0c-.788 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>