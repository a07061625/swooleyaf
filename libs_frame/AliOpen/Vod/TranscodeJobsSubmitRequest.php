<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SubmitTranscodeJobs
 * @method string getResourceOwnerId()
 * @method string getUserData()
 * @method string getResourceOwnerAccount()
 * @method string getVideoId()
 * @method string getOverrideParams()
 * @method string getOwnerId()
 * @method string getPriority()
 * @method string getPipelineId()
 * @method string getTemplateGroupId()
 * @method string getFileUrl()
 * @method string getEncryptConfig()
 */
class TranscodeJobsSubmitRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'SubmitTranscodeJobs', 'vod');
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
     * @param string $videoId
     * @return $this
     */
    public function setVideoId($videoId)
    {
        $this->requestParameters['VideoId'] = $videoId;
        $this->queryParameters['VideoId'] = $videoId;

        return $this;
    }

    /**
     * @param string $overrideParams
     * @return $this
     */
    public function setOverrideParams($overrideParams)
    {
        $this->requestParameters['OverrideParams'] = $overrideParams;
        $this->queryParameters['OverrideParams'] = $overrideParams;

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
     * @param string $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->requestParameters['Priority'] = $priority;
        $this->queryParameters['Priority'] = $priority;

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

    /**
     * @param string $templateGroupId
     * @return $this
     */
    public function setTemplateGroupId($templateGroupId)
    {
        $this->requestParameters['TemplateGroupId'] = $templateGroupId;
        $this->queryParameters['TemplateGroupId'] = $templateGroupId;

        return $this;
    }

    /**
     * @param string $fileUrl
     * @return $this
     */
    public function setFileUrl($fileUrl)
    {
        $this->requestParameters['FileUrl'] = $fileUrl;
        $this->queryParameters['FileUrl'] = $fileUrl;

        return $this;
    }

    /**
     * @param string $encryptConfig
     * @return $this
     */
    public function setEncryptConfig($encryptConfig)
    {
        $this->requestParameters['EncryptConfig'] = $encryptConfig;
        $this->queryParameters['EncryptConfig'] = $encryptConfig;

        return $this;
    }
}
