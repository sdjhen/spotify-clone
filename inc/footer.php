</div>
</div>

</div>

<?php include("inc/nowplayingbarContainer.php"); ?>

<script>
    const audioEl = new Audio();

    document.querySelector('.play').addEventListener('click', () => {
        audioEl.setTrack('assets/music/summer-walk-152722.mp3');
        audioEl.audio.play();
    });
</script>

</main>
<script src="assets/js/script.js"></script>
</body>

</html>