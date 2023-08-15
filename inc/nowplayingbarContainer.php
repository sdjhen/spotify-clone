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
         // Load playlist and initialize player
         const newPlaylist = <?php echo $jsonArray; ?>;
         setTrack(newPlaylist[0], newPlaylist, false);
         updateVolumeProgressBar(audioElement.audio);

         // Prevent audio btns highligthing when dragging progress bar
         $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
             e.preventDefault();
         });

         $(".playbackBar .progressBar").mousedown(function() {
             mouseDown = true;
         });

         $(".playbackBar .progressBar").mousemove(function(e) {
             if (mouseDown == true) {
                 // Set time of song, depending on position of mouse
                 timeFromOffset(e, this);
             }
         });

         $(".playbackBar .progressBar").mouseup(function(e) {
             timeFromOffset(e, this);
         });

         // Volume Bar control
         $(".volumeBar .progressBar").mousedown(function() {
             mouseDown = true;
         });

         $(".volumeBar .progressBar").mousemove(function(e) {
             if (mouseDown == true) {
                 // Set volume of song, depending on position of mouse
                 const volumePecentage = e.offsetX / $(this).width()
                 audioElement.audio.volume = volumePecentage;
             }
         });

         $(".volumeBar .progressBar").mouseup(function(e) {
             const volumePecentage = e.offsetX / $(this).width()
             audioElement.audio.volume = volumePecentage;
         });

         $(document).mouseup(function() {
             mouseDown = false;
         });
     });

     function timeFromOffset(mouse, progressBar) {
         // Calculate time from mouse position in progress bar
         const percentage = (mouse.offsetX / $(progressBar).width()) * 100;
         const seconds = audioElement.audio.duration * (percentage / 100);
         audioElement.setTime(seconds);
     }

     function prevSong() {
         // Previous song control
         if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
             audioElement.setTime(0);
         } else {
             currentIndex--;
             setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
         }
     }

     function nextSong() {
         // Next song control
         if (repeat) {
             audioElement.setTime(0);
             playSong();
             return;
         }

         if (currentIndex == currentPlaylist.length - 1) {
             currentIndex = 0;
         } else {
             currentIndex++;
         }

         const trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
         setTrack(trackToPlay, currentPlaylist, true);
     }

     function setMute() {
         // Mute function
         const volumeButton = $('.controlBtn.volume');
         const muteButton = $('.controlBtn.mute');

         audioElement.audio.muted = true;

         volumeButton.hide();
         muteButton.show();
     }

     function unMute() {
         // Unmute function
         const volumeButton = $('.controlBtn.volume');
         const muteButton = $('.controlBtn.mute');

         audioElement.audio.muted = false;

         volumeButton.show();
         muteButton.hide();
     }

     function shuffleArray(arr) {
         // Shuffle array function
         for (let i = arr.length - 1; i > 0; i--) {
             const j = Math.floor(Math.random() * (i + 1));
             [arr[i], arr[j]] = [arr[j], arr[i]]; // Swap elements
         }
         return arr;
     }

     function setShuffle() {
         // Toggle shuffle function
         shuffle = !shuffle
         const shuffleButton = $('.controlBtn.shuffle');
         const shuffleButtonOn = $('.controlBtn.shuffle-on');

         const isShuffleOn = shuffleButtonOn.is(":visible");

         if (isShuffleOn) {
             shuffleButton.show();
             shuffleButtonOn.hide();
         } else {
             shuffleButton.hide();
             shuffleButtonOn.show();
         }

         if (shuffle) {
             shuffleArray(shufflePlaylist)
             currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id)
         } else {
             currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id)
         }
     }

     function unShuffle() {
         // Turn off shuffle function
         const shuffleButton = $('.controlBtn.shuffle');
         const shuffleButtonOn = $('.controlBtn.shuffle-on');

         shuffleButton.show();
         shuffleButtonOn.hide();

         shuffle = false
     }

     function setRepeat() {
         // Toggle repeat function
         repeat = !repeat;
         const repeatButton = $('.controlBtn.repeat');
         const repeatActiveButton = $('.controlBtn.repeat-active');

         if (repeat) {
             repeatActiveButton.show();
         } else {
             repeatActiveButton.hide();
         }
     }

     // Attach the function to the repeat button
     $(".controlBtn.repeat").click(function() {
         setRepeat();
     });

     // Attach the function to the repeat-active button
     $(".controlBtn.repeat-active").click(function() {
         setRepeat();

         $(".controlBtn.repeat").show();
         $(".controlBtn.repeat-active").hide();

         repeat = false;
     });

     function setTrack(trackID, newPlaylist, play) {
         // Set track from playlist
         if (newPlaylist != currentPlaylist) {
             currentPlaylist = newPlaylist;
             shufflePlaylist = currentPlaylist.slice();
             shuffleArray(shufflePlaylist);
         }

         if (shuffle) {
             currentIndex = shufflePlaylist.indexOf(trackID)
         } else {
             currentIndex = currentPlaylist.indexOf(trackID)
         }
         pauseSong()

         // AJAX call to retrieve song from DB
         $.post("inc/handlers/Ajax/getSongJSON.php", {
             songID: trackID
         }, function(data) {
             // Convert response data into object
             const track = JSON.parse(data);
             $(".trackName span").text(track.title);

             // AJAX call to retrieve artist from DB
             $.post("inc/handlers/Ajax/getArtistJSON.php", {
                 artistID: track.artist
             }, function(data) {
                 const artist = JSON.parse(data);
                 $(".artistName span").text(artist.name);
             });

             // AJAX call to retrieve album artwork from DB
             $.post("inc/handlers/Ajax/getAlbumJSON.php", {
                 albumID: track.album
             }, function(data) {
                 const album = JSON.parse(data);
                 $(".albumLink img").attr("src", album.artworkPath);
             });

             // Set track and play song
             audioElement.setTrack(track);

             if (play === true) {
                 playSong()
             }
         });
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
                         <span class="material-symbols-outlined audioIcon" onclick="setShuffle()">
                             shuffle
                         </span>
                     </button>

                     <button class="controlBtn shuffle-on" title="Shuffle button on" style="display: none;" onclick="unShuffle()">
                         <span class="material-symbols-outlined audioIcon">
                             shuffle_on
                         </span>
                     </button>

                     <button class="controlBtn previous" title="Previous button" onclick="prevSong()">
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

                     <button class="controlBtn next" title="Next button" onclick="nextSong()">
                         <span class="material-symbols-outlined audioIcon">
                             skip_next
                         </span>
                     </button>

                     <button class="controlBtn repeat" title="Repeat button" onclick="setRepeat()">
                         <span class="material-symbols-outlined audioIcon">
                             replay
                         </span>
                     </button>

                     <button class="controlBtn repeat-active" title="Repeat button active" style="display: none;">
                         <span class="material-symbols-outlined" style="    color: #28a745 !important;
                                                    ">
                             repeat_one
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
                 <button class="controlBtn volume" title="Volume button" style="margin-bottom: 9px;" onclick="setMute()">
                     <span class="material-symbols-outlined audioIcon">
                         volume_up
                     </span>
                 </button>
                 <button class="controlBtn mute" title="Mute button" style="margin-bottom: 9px; display: none" onclick="unMute()">
                     <span class="material-symbols-outlined audioIcon">
                         volume_mute
                     </span>
                 </button>

                 <!-- End of Audio Control Buttons -->
                 <div class="progressBar" style="position: relative;">
                     <div class="progressBarBg">
                         <div class="progress"></div>
                     </div>
                 </div>

             </div>
         </div>
         <!-- End of Now playing divs -->
     </div>
 </section>