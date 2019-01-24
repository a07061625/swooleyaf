<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class GroupsListRequest extends RpcAcsRequest {
    private $marker;
    private $maxItems;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "ListGroups");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getMarker(){
        return $this->marker;
    }

    public function setMarker($marker){
        $this->marker = $marker;
        $this->queryParameters["Marker"] = $marker;
    }

    public function getMaxItems(){
        return $this->maxItems;
    }

    public function setMaxItems($maxItems){
        $this->maxItems = $maxItems;
        $this->queryParameters["MaxItems"] = $maxItems;
    }
}