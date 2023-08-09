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

     function playSong() {
         // Update play count
         if (audioElement.audio.currentTime == 0) {
             // AJAX call to update play count
             $.post("inc/handlers/Ajax/updatePlays.php", {
                 songID: audioElement.currentlyPlaying.id
             });
         }

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
         setTrack(currentPlaylist[0], currentPlaylist, false);
         updateVolumeProgressBar(audioElement.audio);

         // Prevent audio btns highligthing when dragging progress bar
         $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
             e.preventDefault()
         })


         $(".playbackBar .progressBar").mousedown(function() {
             mouseDown = true;
         })
         $(".playbackBar .progressBar").mousemove(function(e) {
             if (mouseDown == true) {
                 // Set time of song, depending on position of mouse
                 timeFromOffset(e, this)
             }
         })
         $(".playbackBar .progressBar").mouseup(function(e) {
             timeFromOffset(e, this)
         })

         // Volume Bar control
         $(".volumeBar .progressBar").mousedown(function() {
             mouseDown = true;
         })
         $(".volumeBar .progressBar").mousemove(function(e) {
             if (mouseDown == true) {
                 // Set volume of song, depending on position of mouse
                 const volumePecentage = e.offsetX / $(this).width()
                 audioElement.audio.volume = volumePecentage
             }
         })
         $(".volumeBar .progressBar").mouseup(function(e) {
             const volumePecentage = e.offsetX / $(this).width()
             audioElement.audio.volume = volumePecentage
         })

         $(document).mouseup(function() {
             mouseDown = false;
         })

     });

     function timeFromOffset(mouse, progressBar) {
         const percentage = (mouse.offsetX / $(progressBar).width()) * 100;
         const seconds = audioElement.audio.duration * (percentage / 100);
         audioElement.setTime(seconds);
     }

     function setTrack(trackID, newPlaylist, play) {
         // AJAX call to retrieve song from DB
         $.post("inc/handlers/Ajax/getSongJSON.php", {
             songID: trackID
         }, function(data) {

             // Convert response data into object
             const track = JSON.parse(data)
             //  console.log(track);

             // Output Track name
             $(".trackName span").text(track.title);

             // AJAX call to retrieve artist from DB
             $.post("inc/handlers/Ajax/getArtistJSON.php", {
                 artistID: track.artist
             }, function(data) {
                 const artist = JSON.parse(data)

                 // Output Track name
                 $(".artistName span").text(artist.name);
             });

             // AJAX call to retrieve album artwork from DB
             $.post("inc/handlers/Ajax/getAlbumJSON.php", {
                 albumID: track.album
             }, function(data) {
                 const album = JSON.parse(data)

                 // Output Album artwork
                 $(".albumLink img").attr("src", album.artworkPath);

             })

             // Use to set track & play song
             audioElement.setTrack(track);
             playSong()
         });

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
                     <img src="" class="albumArtwork" style=" height: 100% !important;
    max-width: 57px !important;
    margin-right: 15px !important;
    float: left !important;">
                 </span>
                 <!-- Track Info Labels -->
                 <div class="trackInfo">

                     <span class="trackName">
                         <span></span>
                     </span>

                     <span class="artistName">
                         <span></span>
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
                 <button class="controlBtn volume" title="Volume button" style="margin-bottom: 9px;">
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