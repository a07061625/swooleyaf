<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetImageInfo
 * @method string getResourceOwnerId()
 * @method string getImageId()
 * @method string getOutputType()
 * @method string getAuthTimeout()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerId()
 */
class ImageInfoGetRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'GetImageInfo', 'vod');
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
     * @param string $imageId
     * @return $this
     */
    public function setImageId($imageId)
    {
        $this->requestParameters['ImageId'] = $imageId;
        $this->queryParameters['ImageId'] = $imageId;

        return $this;
    }

    /**
     * @param string $outputType
     * @return $this
     */
    public function setOutputType($outputType)
    {
        $this->requestParameters['OutputType'] = $outputType;
        $this->queryParameters['OutputType'] = $outputType;

        return $this;
    }

    /**
     * @param string $authTimeout
     * @return $this
     */
    public function setAuthTimeout($authTimeout)
    {
        $this->requestParameters['AuthTimeout'] = $authTimeout;
        $this->queryParameters['AuthTimeout'] = $authTimeout;

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
}
