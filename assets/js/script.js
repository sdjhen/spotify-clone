// Set tracks
let currentPlaylist = [];
let audioElement;

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
};

// Audio Player
class Audio {
  constructor() {
    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener('canplay', function () {
      // 'this' refers to the object that the event was called on (audio)
      const duration = formatTime(this.duration);
      $('.progressTime.remaining').text(duration);
    });

    this.audio.addEventListener('timeupdate', function () {
      // console.log('timeupdate event triggered');
      if (this.duration) {
        updateTimeProgressBar(this);
      }
    });
  }

  setTrack(track) {
    this.currentlyPlaying = track;
    this.audio.src = track.path;
  }

  play() {
    this.audio.play();
  }

  pause() {
    this.audio.pause();
  }
}
