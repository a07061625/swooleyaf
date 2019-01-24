<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

class PlayInfoRequest extends RpcAcsRequest {
    private $playDomain;
    private $resourceOwnerId;
    private $formats;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $hlsUriToken;
    private $terminal;
    private $ownerId;
    private $mediaId;
    private $rand;
    private $authTimeout;
    private $authInfo;

    public function __construct(){
        parent::__construct("Mts", "2014-06-18", "PlayInfo", "mts", "openAPI");
        $this->setMethod("POST");
    }

    public function getPlayDomain(){
        return $this->playDomain;
    }

    public function setPlayDomain($playDomain){
        $this->playDomain = $playDomain;
        $this->queryParameters["PlayDomain"] = $playDomain;
    }

    public function getResourceOwnerId(){
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId){
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getFormats(){
        return $this->formats;
    }

    public function setFormats($formats){
        $this->formats = $formats;
        $this->queryParameters["Formats"] = $formats;
    }

    public function getResourceOwnerAccount(){
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount){
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getOwnerAccount(){
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount){
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters["OwnerAccount"] = $ownerAccount;
    }

    public function getHlsUriToken(){
        return $this->hlsUriToken;
    }

    public function setHlsUriToken($hlsUriToken){
        $this->hlsUriToken = $hlsUriToken;
        $this->queryParameters["HlsUriToken"] = $hlsUriToken;
    }

    public function getTerminal(){
        return $this->terminal;
    }

    public function setTerminal($terminal){
        $this->terminal = $terminal;
        $this->queryParameters["Terminal"] = $terminal;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

    public function getMediaId(){
        return $this->mediaId;
    }

    public function setMediaId($mediaId){
        $this->mediaId = $mediaId;
        $this->queryParameters["MediaId"] = $mediaId;
    }

    public function getRand(){
        return $this->rand;
    }

    public function setRand($rand){
        $this->rand = $rand;
        $this->queryParameters["Rand"] = $rand;
    }

    public function getAuthTimeout(){
        return $this->authTimeout;
    }

    public function setAuthTimeout($authTimeout){
        $this->authTimeout = $authTimeout;
        $this->queryParameters["AuthTimeout"] = $authTimeout;
    }

    public function getAuthInfo(){
        return $this->authInfo;
    }

    public function setAuthInfo($authInfo){
        $this->authInfo = $authInfo;
        $this->queryParameters["AuthInfo"] = $authInfo;
    }
}