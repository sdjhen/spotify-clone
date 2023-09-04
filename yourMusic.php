<?php
include("inc/includedFiles.php");
?>

<!-- User Playlists -->
<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2 style="    display: block;
    position: fixed;
    right: 655;
    padding-top: 35px;">PLAYLISTS</h2>
        <div class="buttonItems">
            <button class="button green" onclick="createPlaylist()" style="  position: absolute;
    margin-left: auto;
    margin-right: auto;
    margin-top: 100px;
    left: 0;
    right: 0;
    width: 175px;">NEW PLAYLIST</button>
        </div>
    </div>

    <?php
    $username = $userLoggedIn->getUserName();

    $playlistsQuery = mysqli_query($con, "SELECT * FROM playlists  WHERE owner='$username' ");

    if (mysqli_num_rows($playlistsQuery) == 0) {
        echo "<span class='noResults'>No playlists found</span>";
    }

    while ($row = mysqli_fetch_array($playlistsQuery)) {
        echo "<div class='gridViewItem'>
        <div class='gridViewInfo'>" . $row['title'] .
            "</div>
            </div>";
    }

    ?>




</div>