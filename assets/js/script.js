// Set tracks
let currentPlaylist = [];
let audioElement;

const formatTime = (seconds) => {
  const roundedSeconds = Math.round(seconds);
  const minutes = Math.floor(roundedSeconds / 60); // Rounds down
  const remainingSeconds = roundedSeconds - minutes * 60;

  return minutes + `:` + remainingSeconds;
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
