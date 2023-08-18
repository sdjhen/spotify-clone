<?php
include("inc/includedFiles.php");

// Get user search term
if (isset($_GET['term'])) {
    $term = urldecode($_GET['term']); // Convert URL encoded str to regular str
} else {
    $term = "";
}
?>

<!-- Search Bar Page -->
<div class="searchContainer">
    <h4>Search for an Artist, Album or Song</h4>
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">
</div>

<script>
    $(function() {

        $(".searchInput").focus() // Focus input to prevent accidental timeout

        // Reset timer until user stops typing
        $(".searchInput").keyup(function() {
            clearTimeout(timer)

            timer = setTimeout(() => {
                const value = $(".searchInput").val();
                openPage("search.php?term=" + value);
            }, 2000) // Perform search 2s after typing finishes
        })
    })
</script>

<?php if ($term == "") exit() ?>

<div class="tracklistContainer BorderBottom">
    <h2 style="text-align: center;">SONGS</h2>
    <ul class="tracklist">

        <?php
        $songQuery = mysqli_query($con, "SELECT id FROM Songs WHERE title LIKE '$term%' LIMIT 10");

        if (mysqli_num_rows($songQuery) == 0) {
            echo "<span class='noResults'> No results found matching " . $term . "</span> ";
        }


        $songIDArray = array();

        $i = 1;
        while ($row = mysqli_fetch_array($songQuery)) {

            if ($i > 15) {
                break;
            }

            array_push($songIDArray, $row['id']);

            $albumSong = new Song($con, $row['id']);
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

<!-- Artist Search Results -->
<div class="artistContainer borderBottom">
    <h2 style="text-align: center;">ARTISTS</h2>

    <?php
    $artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");

    if (mysqli_num_rows($artistQuery) == 0) {
        echo "<span class='noResults'> No results found matching " . $term . "</span> ";
    }

    while ($row = mysqli_fetch_array($artistQuery)) {
        $artist_found = new Artist($con, $row['id']);

        echo "<div class='searchResultRow'>
            <div class='artistName>
            
            <span role='link tabindex='0' onclick='openPage(\"artist.php?id=" . $artist_found->getID() . " \")'>
             "
            . $artist_found->getName() .
            "
            </span>

            </div>
            </div>";
    }

    ?>



</div>

<div class="gridViewContainer album-item">
    <h2>ALBUMS</h2>

    <?php

    $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");

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

    if (mysqli_num_rows($albumQuery) == 0) {
        echo "<span class='noResults'> No results found matching " . $term . "</span> ";
    }

    ?>
</div>