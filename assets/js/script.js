// Set tracks
let currentPlaylist = [];
let audioElement;

// Audio Player
class Audio {
  constructor() {
    this.currentlyPlaying;
    this.audio = document.createElement('audio');
  }

  setTrack(src) {
    this.audio.src = src;
  }

  play() {
    this.audio.play();
  }

  pause() {
    this.audio.pause();
  }
}
