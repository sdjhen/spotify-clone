// Set tracks
let currentPlaylist = [];
let audioElement;

// Audio Player
class Audio {
  constructor() {
    this.currentlyPlaying;
    this.audio = document.createElement('audio');
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
