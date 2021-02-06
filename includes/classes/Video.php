<?php
class Video {
    private $con, $sqlData, $entity;

    public function __construct($con, $input) {
        $this->con = $con;

        if(is_array($input)) {
            $this->sqlData = $input;
        }
        else {
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
            $query->bindValue(":id", $input);
            $query->execute();

            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }

        $this->entity = new Entity($con, $this->sqlData["entityId"]);
    }

    // pulling from db
    public function getId() {
        return $this->sqlData["id"];
    }

    public function getTitle() {
        return $this->sqlData["title"];
    }

    public function getDescription() {
        return $this->sqlData["description"];
    }

    public function getFilePath() {
        return $this->sqlData["filePath"];
    }

    // not directly frpm db its in the enity
    public function getThumbnail() {
        return $this->entity->getThumbnail();
    }

    public function getEpisodeNumber() {
        return $this->sqlData["episode"];
    }

    public function getSeasonNumber() {
        return $this->sqlData["season"];
    }

    public function getEntityId() {
        return $this->sqlData["entityId"];
    }

    // logic for tracking views
    public function incrementViews() {
        $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindValue(":id", $this->getId());
        $query->execute();
    }

    public function getSeasonAndEpisode() {
    if($this->isMovie()) {
        return;
    }

    $season = $this->getSeasonNumber();
    $episode = $this->getEpisodeNumber();

    return "Season $season, Episode $episode";
}

// checking to see if video is a movie
    public function isMovie() {
    return $this->sqlData["isMovie"] == 1;
}

// show continue if user was been watching a speficic program on the play button
public function isInProgress($username) {
    $query = $this->con->prepare("SELECT * FROM videoProgress
                                WHERE videoId=:videoId AND username=:username");
                                
    $query->bindValue(":videoId", $this->getId());
    $query->bindValue(":username", $username);
    $query->execute();

    return $query->rowCount() != 0;
}

public function hasSeen($username) {
    $query = $this->con->prepare("SELECT * FROM videoProgress
                                WHERE videoId=:videoId AND username=:username
                                AND finished=1");

    $query->bindValue(":videoId", $this->getId());
    $query->bindValue(":username", $username);
    $query->execute();

    return $query->rowCount() != 0;
    }
}
?>