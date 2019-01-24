<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

class CasterEpisodeGroupDeleteRequest extends RpcAcsRequest {
    private $ownerId;
    private $programId;

    public function __construct(){
        parent::__construct("live", "2016-11-01", "DeleteCasterEpisodeGroup", "live", "openAPI");
        $this->setMethod("POST");
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getProgramId(){
        return $this->programId;
    }

    public function setProgramId($programId){
        $this->programId = $programId;
        $this->queryParameters["ProgramId"] = $programId;
    }
}