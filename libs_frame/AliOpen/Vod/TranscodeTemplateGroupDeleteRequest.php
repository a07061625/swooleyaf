<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteTranscodeTemplateGroup
 * @method string getResourceOwnerId()
 * @method string getTranscodeTemplateIds()
 * @method string getForceDelGroup()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerId()
 * @method string getTranscodeTemplateGroupId()
 */
class TranscodeTemplateGroupDeleteRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'DeleteTranscodeTemplateGroup', 'vod');
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
     * @param string $transcodeTemplateIds
     * @return $this
     */
    public function setTranscodeTemplateIds($transcodeTemplateIds)
    {
        $this->requestParameters['TranscodeTemplateIds'] = $transcodeTemplateIds;
        $this->queryParameters['TranscodeTemplateIds'] = $transcodeTemplateIds;

        return $this;
    }

    /**
     * @param string $forceDelGroup
     * @return $this
     */
    public function setForceDelGroup($forceDelGroup)
    {
        $this->requestParameters['ForceDelGroup'] = $forceDelGroup;
        $this->queryParameters['ForceDelGroup'] = $forceDelGroup;

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
}
