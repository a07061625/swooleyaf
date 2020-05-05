<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SubmitImageSearchJob
 * @method string getInputImage()
 * @method string getUserData()
 * @method string getResourceOwnerId()
 * @method string getFpDBId()
 * @method string getResourceOwnerAccount()
 * @method string getInputVideo()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getConfig()
 * @method string getPipelineId()
 */
class ImageSearchJobSubmitRequest extends RpcAcsRequest
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
        parent::__construct('Mts', '2014-06-18', 'SubmitImageSearchJob', 'mts');
    }

    /**
     * @param string $inputImage
     * @return $this
     */
    public function setInputImage($inputImage)
    {
        $this->requestParameters['InputImage'] = $inputImage;
        $this->queryParameters['InputImage'] = $inputImage;

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
     * @param string $fpDBId
     * @return $this
     */
    public function setFpDBId($fpDBId)
    {
        $this->requestParameters['FpDBId'] = $fpDBId;
        $this->queryParameters['FpDBId'] = $fpDBId;

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
     * @param string $inputVideo
     * @return $this
     */
    public function setInputVideo($inputVideo)
    {
        $this->requestParameters['InputVideo'] = $inputVideo;
        $this->queryParameters['InputVideo'] = $inputVideo;

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
     * @param string $config
     * @return $this
     */
    public function setConfig($config)
    {
        $this->requestParameters['Config'] = $config;
        $this->queryParameters['Config'] = $config;

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
