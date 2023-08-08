 <?php
    // Retrieve 10 random songs from DB
    $songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");

    $resultArray = array();
    // Loop & push into empty results array
    while ($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    // Convert to JSON 
    $jsonArray = json_encode($resultArray);
    ?>

 <script>
     // Create an instance of the Audio class
     audioElement = new Audio();

     // Function to play song
     function playSong() {
         $(".controlBtn.play").hide()
         $(".controlBtn.pause").show()
         audioElement.play();
     }

     // Function to pause song
     function pauseSong() {
         $(".controlBtn.pause").hide()
         $(".controlBtn.play").show()
         audioElement.pause();
     }

     // Execute script only when page is ready
     $(document).ready(function() {
         currentPlaylist = <?php echo $jsonArray; ?>;
         setTrack(currentPlaylist[0], currentPlaylist, true);
     });

     // Function to set track
     function setTrack(trackID, newPlaylist, play) {
         // AJAX call to retrieve song from DB
         $.post("inc/handlers/Ajax/getSongJSON.php", {
             songID: trackID
         }, function(data) {
             console.log(data);
         })
         if (play === true) {
             audioElement.play();
         }
     }
 </script>

 <!-- Now Playing -->
 <section id="nowPlayingBarContainer">
     <div id="nowPlayingBar">
         <!-- Now Playing divs -->
         <div id="nowPlayingLeft">
             <div class="content">
                 <span class="albumLink">
                     <img src="/" class="albumArtwork">
                 </span>
                 <!-- Track Info Labels -->
                 <div class="trackInfo">

                     <span class="trackName">
                         <span>Right here</span>
                     </span>

                     <span class="artistName">
                         <span>Sam Hendry</span>
                     </span>

                 </div>
                 <!-- End of Track Info Labels -->
             </div>
         </div>

         <div id="nowPlayingCenter">
             <div class="content playerControls">

                 <div class="buttons">
                     <!-- Audio Control Buttons -->
                     <button class="controlBtn shuffle" title="Shuffle button">
                         <span class="material-symbols-outlined audioIcon">
                             shuffle
                         </span>
                     </button>

                     <button class="controlBtn previous" title="Previous button">
                         <span class="material-symbols-outlined audioIcon">
                             skip_previous
                         </span>
                     </button>

                     <button class="controlBtn play" title="Play button" onclick="playSong()">
                         <span class="material-symbols-outlined audioIcon">
                             play_circle
                         </span>
                     </button>

                     <button class="controlBtn pause" title="Pause button" style="display: none;" onclick="pauseSong()">
                         <span class="material-symbols-outlined audioIcon">
                             pause
                         </span>
                     </button>

                     <button class="controlBtn next" title="Next button">
                         <span class="material-symbols-outlined audioIcon">
                             skip_next
                         </span>
                     </button>

                     <button class="controlBtn repeat" title="Repeat button">
                         <span class="material-symbols-outlined audioIcon">
                             replay
                         </span>
                     </button>
                 </div>


                 <div class="playbackBar">

                     <span class="progressTime current">0.00</span>
                     <div class="progressBar">
                         <div class="progressBarBg">
                             <div class="progress"></div>
                         </div>
                     </div>
                     <span class="progressTime remaining">0.00</span>
                 </div>

             </div>
         </div>
         <!-- Right-Side Volume Bar -->
         <div id="nowPlayingRight">
             <div class="volumeBar">
                 <button class="controlBtn volume" title="Volume button">
                     <span class="material-symbols-outlined audioIcon">
                         volume_up
                     </span>
                 </button>
                 <!-- End of Audio Control Buttons -->
                 <div class="progressBar">
                     <div class="progressBarBg">
                         <div class="progress"></div>
                     </div>
                 </div>

             </div>
         </div>
         <!-- End of Now playing divs -->
     </div>
 </section>