<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterProgramModifyRequest extends RpcAcsRequest {
    private $casterId;
    private $Episodes;
    private $ownerId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "ModifyCasterProgram", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getEpisodes(){
        return $this->Episodes;
    }

    public function setEpisodes($Episodes){
        $this->Episodes = $Episodes;
        for ($i = 0; $i < count($Episodes); $i ++) {
            $this->queryParameters['Episode.' . ($i + 1) . '.ResourceId'] = $Episodes[$i]['ResourceId'];
            for ($j = 0; $j < count($Episodes[$i]['ComponentIds']); $j ++) {
                $this->queryParameters['Episode.' . ($i + 1) . '.ComponentId.' . ($j + 1)] = $Episodes[$i]['ComponentIds'][$j];
            }
            $this->queryParameters['Episode.' . ($i + 1) . '.SwitchType'] = $Episodes[$i]['SwitchType'];
            $this->queryParameters['Episode.' . ($i + 1) . '.EpisodeType'] = $Episodes[$i]['EpisodeType'];
            $this->queryParameters['Episode.' . ($i + 1) . '.EpisodeName'] = $Episodes[$i]['EpisodeName'];
            $this->queryParameters['Episode.' . ($i + 1) . '.EndTime'] = $Episodes[$i]['EndTime'];
            $this->queryParameters['Episode.' . ($i + 1) . '.StartTime'] = $Episodes[$i]['StartTime'];
            $this->queryParameters['Episode.' . ($i + 1) . '.EpisodeId'] = $Episodes[$i]['EpisodeId'];
        }
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }
}