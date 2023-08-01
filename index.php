<?php
include("inc/config.php");

// Set session variable
if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    // Redirect to registration page if not set
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title> Welcome | Samify</title>
</head>

<body>

    <main id="mainContainer">
        <div id="topContainer">
            <!-- Navigation Menu -->
            <div id="navbarContainer">
                <nav class="navbar">
                    <!-- Logo -->
                    <img src="./assets/img/logo2.png" class="logo" alt="logo">

                    <!-- Nav Menu Items -->
                    <div class="group">
                        <div class="navItem">
                            <!-- Search Bar -->
                            <a href="search.php" class="navItemLink">Search
                                <span class="material-symbols-outlined icon">
                                    search
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="group">
                        <div class="navItem">
                            <a href="browse.php" class="navItemLink">Browse</a>
                        </div>

                        <div class="navItem">
                            <a href="music.php" class="navItemLink">Your Music</a>
                        </div>

                        <div class="navItem">
                            <a href="profile.php" class="navItemLink">Sam Hendry</a>
                        </div>
                    </div>
                </nav>

            </div>
        </div>

        <!-- Now Playing -->
        <section id="nowPlayingBarContainer">
            <div id="nowPlayingBar">
                <!-- Now Playing divs -->
                <div id="nowPlayingLeft">
                    <div class="content">
                        <span class="albumLink">
                            <img src="/" class="albumArtwork">
                        </span>
                        <!-- Track Info Labels -->
                        <div class="trackInfo">

                            <span class="trackName">
                                <span>Right here</span>
                            </span>

                            <span class="artistName">
                                <span>Sam Hendry</span>
                            </span>

                        </div>
                        <!-- End of Track Info Labels -->
                    </div>
                </div>

                <div id="nowPlayingCenter">
                    <div class="content playerControls">

                        <div class="buttons">
                            <!-- Audio Control Buttons -->
                            <button class="controlBtn shuffle" title="Shuffle button">
                                <span class="material-symbols-outlined audioIcon">
                                    shuffle
                                </span>
                            </button>

                            <button class="controlBtn previous" title="Previous button">
                                <span class="material-symbols-outlined audioIcon">
                                    skip_previous
                                </span>
                            </button>

                            <button class="controlBtn play" title="Play button">
                                <span class="material-symbols-outlined audioIcon">
                                    play_circle
                                </span>
                            </button>

                            <button class="controlBtn pause" title="Pause button" style="display: none;">
                                <span class="material-symbols-outlined audioIcon">
                                    pause
                                </span>
                            </button>

                            <button class="controlBtn next" title="Next button">
                                <span class="material-symbols-outlined audioIcon">
                                    skip_next
                                </span>
                            </button>

                            <button class="controlBtn repeat" title="Repeat button">
                                <span class="material-symbols-outlined audioIcon">
                                    replay
                                </span>
                            </button>
                        </div>


                        <div class="playbackBar">

                            <span class="progressTime current">0.00</span>
                            <div class="progressBar">
                                <div class="progressBarBg">
                                    <div class="progress"></div>
                                </div>
                            </div>
                            <span class="progressTime remaining">0.00</span>
                        </div>

                    </div>
                </div>

                <div id="nowPlayingRight">
                    <div class="volumeBar">
                        <button class="controlBtn volume" title="Volume button">
                            <span class="material-symbols-outlined audioIcon">
                                volume_up
                            </span>
                        </button>
                        <!-- End of Audio Control Buttons -->
                        <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End of Now playing divs -->
            </div>
        </section>

    </main>
</body>

</html>