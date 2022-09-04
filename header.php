<header>
    <nav class="navbar bg-light shadow mb-5 rounded">
        <div class="container-fluid">
            <!-- Logo -->
            <a href="index.php" onmousedown='return false;' onselectstart='return false;'>
                <img src="img/logo.png" alt="" width="180" height="70" class="d-inline-block align-text-top">
            </a>
            <!-- Search -->
            <div class=" ">
                <form class="form-group input-group" action="search.php" method="get">
                    <input class="form-control mr-sm-2" type="search" name="username" id="searchbar_input" size="80"
                           aria-label="Search">
                    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

            <!-- Button for "log out" with buttons for "home" and "profile"-->
            <div onmousedown='return false;' onselectstart='return false;'>
                <a href="index.php" class="btn btn-light linkForButtons">
                    <img id="header_home_img"
                         src="https://cdn.discordapp.com/attachments/943544446551752746/973269731534577694/unknown.png"
                         alt="home">
                </a>
                <a href="profile.php?username=<?php echo $_SESSION["username"] ?>" class="btn btn-light linkForButtons">
                    <img src="https://cdn.discordapp.com/attachments/943544446551752746/973272366648021052/unknown.png"
                         alt="profile" id="header_profile_img">
                </a>
                <a href="user/logout.php" class="btn btn-secondary linkForButtons">
                    Log Out
                </a>
            </div>
        </div>
    </nav>
</header>