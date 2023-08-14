<?php

class Song
{
    private $con;
    private $id;
    private $mysqliData;
    private $title;
    private $artistID;
    private $albumID;
    private $genre;
    private $duration;
    private $path;

    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;

        $query = mysqli_query($this->con, "SELECT * FROM Songs WHERE id='$this->id'");
        $this->mysqliData = mysqli_fetch_array($query);
        $this->title = $this->mysqliData['title'];
        $this->artistID = $this->mysqliData['artist'];
        $this->albumID = $this->mysqliData['album'];
        $this->genre = $this->mysqliData['genre'];
        $this->duration = $this->mysqliData['duration'];
        $this->path = $this->mysqliData['path'];
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getID()
    {
        return $this->id;
    }
    public function getArtist()
    {
        return new Artist($this->con, $this->artistID);
    }
    public function getAlbum()
    {
        return new Album($this->con, $this->albumID);
    }
    public function getGenre()
    {
        return $this->genre;
    }

    public function getPath()
    {
        return $this->path;
    }
    public function getDuration()
    {
        return $this->duration;
    }
    public function getMysqliData()
    {
        return $this->mysqliData;
    }
}
