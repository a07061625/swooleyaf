<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SubmitMediaDetailJob
 * @method string getInput()
 * @method string getUserData()
 * @method string getResourceOwnerId()
 * @method string getMediaDetailConfig()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getPipelineId()
 */
class MediaDetailJobSubmitRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Mts', '2014-06-18', 'SubmitMediaDetailJob', 'mts');
    }

    /**
     * @param string $input
     * @return $this
     */
    public function setInput($input)
    {
        $this->requestParameters['Input'] = $input;
        $this->queryParameters['Input'] = $input;

        return $this;
    }

    /**
     * @param string $userData
     * @return $this
     */
    public function setUserData($userData)
    {
        $this->requestParameters['UserData'] = $userData;
        $this->queryParameters['UserData'] = $userData;

        return $this;
    }

    /**
     * @param string $resourceOwnerId
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $mediaDetailConfig
     * @return $this
     */
    public function setMediaDetailConfig($mediaDetailConfig)
    {
        $this->requestParameters['MediaDetailConfig'] = $mediaDetailConfig;
        $this->queryParameters['MediaDetailConfig'] = $mediaDetailConfig;

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $ownerAccount
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

        return $this;
    }

    /**
     * @param string $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $pipelineId
     * @return $this
     */
    public function setPipelineId($pipelineId)
    {
        $this->requestParameters['PipelineId'] = $pipelineId;
        $this->queryParameters['PipelineId'] = $pipelineId;

        return $this;
    }
}
