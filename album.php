<?php include("inc/header.php");

if (isset($_GET['id'])) {
    $albumID = $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumID);
// Call getArtist Function
$artist = $album->getArtist();
?>

<div class="entityInfo">

    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="Album Artwork">
    </div>

    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->GetNumberOfSongs(); ?> Songs</p>
    </div>

    <!-- Track List -->
    <div class="tracklistContainer">
        <ul class="tracklist">

            <?php
            $songIDArray = $album->getSongIDs();

            $i = 1;
            foreach ($songIDArray as $songID) {

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
</div>

<?php include("inc/footer.php"); ?>