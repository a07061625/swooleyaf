<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UpdateTranscodeTemplateGroup
 * @method string getTranscodeTemplateList()
 * @method string getResourceOwnerId()
 * @method string getLocked()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerId()
 * @method string getTranscodeTemplateGroupId()
 * @method string getName()
 */
class TranscodeTemplateGroupUpdateRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'UpdateTranscodeTemplateGroup', 'vod');
    }

    /**
     * @param string $transcodeTemplateList
     * @return $this
     */
    public function setTranscodeTemplateList($transcodeTemplateList)
    {
        $this->requestParameters['TranscodeTemplateList'] = $transcodeTemplateList;
        $this->queryParameters['TranscodeTemplateList'] = $transcodeTemplateList;

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
     * @param string $locked
     * @return $this
     */
    public function setLocked($locked)
    {
        $this->requestParameters['Locked'] = $locked;
        $this->queryParameters['Locked'] = $locked;

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
     * @param string $transcodeTemplateGroupId
     * @return $this
     */
    public function setTranscodeTemplateGroupId($transcodeTemplateGroupId)
    {
        $this->requestParameters['TranscodeTemplateGroupId'] = $transcodeTemplateGroupId;
        $this->queryParameters['TranscodeTemplateGroupId'] = $transcodeTemplateGroupId;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }
}
