// Set tracks
let currentPlaylist = [];
let audioEl;

// Audio Player
class Audio {
  constructor() {
    this.currentlyPlaying;
    this.audio = document.createElement('audio');
  }
  setTrack(src) {
    this.audio.src = src;
  }
}
