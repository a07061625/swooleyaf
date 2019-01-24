<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterEpisodeModifyRequest extends RpcAcsRequest {
    private $resourceId;
    private $ComponentIds;
    private $switchType;
    private $casterId;
    private $episodeName;
    private $endTime;
    private $startTime;
    private $ownerId;
    private $episodeId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "ModifyCasterEpisode", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getResourceId(){
        return $this->resourceId;
    }

    public function setResourceId($resourceId){
        $this->resourceId = $resourceId;
        $this->queryParameters["ResourceId"] = $resourceId;
    }

    public function getComponentIds(){
        return $this->ComponentIds;
    }

    public function setComponentIds($ComponentIds){
        $this->ComponentIds = $ComponentIds;
        for ($i = 0; $i < count($ComponentIds); $i ++) {
            $this->queryParameters["ComponentId." . ($i + 1)] = $ComponentIds[$i];
        }
    }

    public function getSwitchType(){
        return $this->switchType;
    }

    public function setSwitchType($switchType){
        $this->switchType = $switchType;
        $this->queryParameters["SwitchType"] = $switchType;
    }

    public function getCasterId(){
        return $this->casterId;
    }

    public function setCasterId($casterId){
        $this->casterId = $casterId;
        $this->queryParameters["CasterId"] = $casterId;
    }

    public function getEpisodeName(){
        return $this->episodeName;
    }

    public function setEpisodeName($episodeName){
        $this->episodeName = $episodeName;
        $this->queryParameters["EpisodeName"] = $episodeName;
    }

    public function getEndTime(){
        return $this->endTime;
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
        $this->queryParameters["EndTime"] = $endTime;
    }

    public function getStartTime(){
        return $this->startTime;
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
        $this->queryParameters["StartTime"] = $startTime;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getEpisodeId(){
        return $this->episodeId;
    }

    public function setEpisodeId($episodeId){
        $this->episodeId = $episodeId;
        $this->queryParameters["EpisodeId"] = $episodeId;
    }
}