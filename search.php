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
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing...">
</div>