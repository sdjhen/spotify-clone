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
    <title> Welcome | Spotify Clone</title>
</head>

<body>
    <div id="nowPlayingBarContainer">
        <div id="nowPlayingBar">
            <!-- Now Playing divs -->
            <div id="nowPlayingLeft">

            </div>

            <div id="nowPlayingCenter">
                <div class="content playerControls">

                    <div class="buttons">

                        <button class="controlBtn shuffle" title="Shuffle button">
                            <span class="material-symbols-outlined">
                                shuffle
                            </span>
                        </button>

                        <button class="controlBtn previous" title="Previous button">
                            <span class="material-symbols-outlined">
                                skip_previous
                            </span>
                        </button>

                        <button class="controlBtn play" title="Play button">
                            <span class="material-symbols-outlined">
                                play_circle
                            </span>
                        </button>

                        <button class="controlBtn pause" title="Pause button" style="display: none;">
                            <span class="material-symbols-outlined">
                                pause
                            </span>
                        </button>

                        <button class="controlBtn next" title="Next button">
                            <span class="material-symbols-outlined">
                                skip_next
                            </span>
                        </button>

                        <button class="controlBtn repeat" title="Repeat button">
                            <span class="material-symbols-outlined">
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

            </div>
            <!-- End of Now playing divs -->
        </div>
    </div>
</body>

</html>