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
        <span>By <?php echo $artist->getName(); ?></span>
    </div>

</div>

<?php include("inc/footer.php"); ?>