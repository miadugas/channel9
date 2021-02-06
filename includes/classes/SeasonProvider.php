<?php
class SeasonProvider {
    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function create($entity) {
        $seasons = $entity->getSeasons();

        // season with no results
        if(sizeof($seasons) == 0) {
            return;
        }

        // get seasons
        $seasonsHtml = "";
        foreach($seasons as $season) {
            // season number 
            $seasonNumber = $season->getSeasonNumber();

            // get my array of videos
            $videosHtml = "";
            foreach($season->getVideos() as $video) {
                $videosHtml .= $this->createVideoSquare($video);
            }

            // html output
            $seasonsHtml .= "<div class='season'>
                                    <h3>Season $seasonNumber</h3>
                                    <div class='videos'>
                                        $videosHtml
                                    </div>
                                </div>";
        }

        return $seasonsHtml;
    }

    // Video thumbnail
    private function createVideoSquare($video) {
        $id = $video->getId();
        $thumbnail = $video->getThumbnail();
        $name = $video->getTitle();
        $description = $video->getDescription();
        $episodeNumber = $video->getEpisodeNumber();
        $hasSeen = $video->hasSeen($this->username) ? "<i class='fas fa-check-circle seen'></i>" : "";

        // output to user, watch page
        return "<a href='watch.php?id=$id'>
                    <div class='episodeContainer'>
                        <div class='contents'>

                            <img src='$thumbnail'>

                            <div class='videoInfo'>
                                <h4>$episodeNumber. $name</h4>
                                <span>$description</span>
                            </div>

                                $hasSeen
                                
                        </div>
                    </div>
                </a>";
    }
}
?>