<?php include("inc/header.php"); ?>

<h1 class="pageHeadingBig">You Might Also Like</h1>
<div class="gridViewContainer">
    <?php
    // Connect to SQL DB and select albums by random
    $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

    // Loop through album DB table & output values
    while ($row = mysqli_fetch_array($albumQuery)) {
        echo "<div class='gridViewItem'>
                <a href='album.php?id=" . $row['id'] . "'>
            <img src='" . $row['artworkPath'] . "'>
            <div class='gridViewInfo'>" . $row['title'] .
            "</div>
                </a>
            </div>";
    }
    ?>
</div>


</div>




<?php include("inc/footer.php"); ?>