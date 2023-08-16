<?php
include("inc/includedFiles.php");

if (isset($_GET['id'])) {
    $artistID = $_GET['id'];
} else {
    header("Location: index.php");
}

$artist = new Artist($con, $artistID);
?>

<div class="entityInfo BorderBottom">
    <div class="centerSection" style="
    margin: auto;
    display: block;
    text-align: center;
    width: 90%;
">
        <div class="artistInfo">
            <h1 class="artistName"><?php echo $artist->getName() ?></h1>
            <div class="headerButtons">
                <button class="button green">PLAY</button>
            </div>
        </div>
    </div>

</div>

<!-- Artist Track List -->
<div class="tracklistContainer BorderBottom">
    <h2 style="text-align: center;">SONGS</h2>
    <ul class="tracklist">


        <?php
        $songIDArray = $artist->getSongIDs();

        $i = 1;
        foreach ($songIDArray as $songID) {

            if ($i > 6) {
                break;
            }

            $albumSong = new Song($con, $songID);
            $albumArtist = $albumSong->getArtist();

            echo "<li class='tracklistRow'>
                <div class='trackCount'>
                    <span class='material-symbols-outlined' onclick='setTrack(\"" . $albumSong->getID() . "\", tempPlaylist, true)'>
                        play_arrow</span>
                    <span class='trackNumber'>$i</span>
                </div>
        
                <div class='trackInfo'>
                    <span class ='trackName'>" . $albumSong->getTitle() . " </span> 
                   
                    <span class='artistName'>" . $albumArtist->getName() . "</span>
                </div>
        
                <div class='trackOptions'>
                    <img class='optionsButton' src='assets/img/icons/options.png'>
                </div>
        
                <div class='trackDuration'>
                    <span class='duration'>" . $albumSong->getDuration() . "</span>
                </div>
            </li>";

            $i++;
        }

        ?>

        <script>
            const tempSongIDs = '<?php echo json_encode($songIDArray); ?>';
            tempPlaylist = JSON.parse(tempSongIDs)
        </script>

    </ul>
</div>

<!-- Artist Album List -->
<div class="gridViewContainer album-item">
    <h2>ALBUMS</h2>

    <?php
    // Connect to SQL DB and select albums by random
    $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist='$artistID'");

    // Loop through album DB table & output values
    while ($row = mysqli_fetch_array($albumQuery)) {
        echo "<div class='gridViewItem'>
                 <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
            <img src='" . $row['artworkPath'] . "'>
            <div class='gridViewInfo'>" . $row['title'] .
            "</div>
                </span>
            </div>";
    }
    ?>
</div>