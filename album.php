<?php include("inc/header.php");

if (isset($_GET['id'])) {
    $albumID = $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumID);

// Call getArtist Function
$artist = $album->getArtist();

// Print album title and artist name
echo $album->getTitle() . '<br>';
echo $artist->getName();


?>

<?php include("inc/footer.php"); ?>
