// Set tracks
let currentPlaylist = [];
let audioElement;
let mouseDown = false; // Drag progress bar

const formatTime = (seconds) => {
  const roundedSeconds = Math.round(seconds);
  const minutes = Math.floor(roundedSeconds / 60); // Rounds down
  const remainingSeconds = roundedSeconds - minutes * 60;
  const formattedSeconds =
    remainingSeconds < 10 ? `0${remainingSeconds}` : remainingSeconds;

  return `${minutes}:${formattedSeconds}`;
};

const updateTimeProgressBar = (audio) => {
  $('.progressTime.current').text(formatTime(audio.currentTime));
  $('.progressTime.remaining').text(
    formatTime(audio.duration - audio.currentTime)
  );
  // Calculate % of song remaining
  const progress = (audio.currentTime / audio.duration) * 100;
  // Fill progress bar as % of song played
  $('.playbackBar .progress').css('width', progress + `%`);
};

const updateVolumeProgressBar = (audio) => {
  const volume = audio.volume * 100;
  // Fill progress bar to increase song volume
  $('.volumeBar .progress').css('width', volume + `%`);
};

// Audio Player
class Audio {
  constructor() {
    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener('canplay', function () {
      // 'this' refers to the object that the event was called on (audio)
      const duration = formatTime(this.duration);
      // Progress time as song plays (second by second)
      $('.progressTime.remaining').text(duration);
    });

    this.audio.addEventListener('timeupdate', function () {
      if (this.duration) {
        updateTimeProgressBar(this);
      }
    });

    this.audio.addEventListener('volumechange', function () {
      updateVolumeProgressBar(this);
    });
  }

  setTrack(track) {
    this.currentlyPlaying = track;
    this.audio.src = track.path;
  }

  // Audio control functions
  play() {
    this.audio.play();
  }

  pause() {
    this.audio.pause();
  }

  setTime(seconds) {
    this.audio.currentTime = seconds;
  }
}
