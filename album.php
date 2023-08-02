<?php include("inc/header.php");

if (isset($_GET['id'])) {
    $albumID = $_GET['id'];
} else {
    header("Location: index.php");
}

// Fetch album data from SQL DB
$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumID'");
$album = mysqli_fetch_array($albumQuery);

// Check if artist ID is available
if ($album['artist'] !== null) {
    // Create an instance of the Artist class
    $artist = new Artist($con, $album['artist']);

    // Print album title and artist name
    echo $album['title'] . '<br>';
    echo $artist->getName();
} else {
    // Print album title and a message if no artist is available
    echo $album['title'] . '<br>';
    echo "No artist available.";
}

?>

<?php include("inc/footer.php"); ?>
