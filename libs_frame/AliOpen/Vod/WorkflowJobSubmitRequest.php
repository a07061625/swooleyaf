<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SubmitWorkflowJob
 * @method string getResourceOwnerId()
 * @method string getWorkflowId()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerId()
 * @method string getMediaId()
 * @method string getFileUrl()
 */
class WorkflowJobSubmitRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'SubmitWorkflowJob', 'vod');
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
     * @param string $workflowId
     * @return $this
     */
    public function setWorkflowId($workflowId)
    {
        $this->requestParameters['WorkflowId'] = $workflowId;
        $this->queryParameters['WorkflowId'] = $workflowId;

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
     * @param string $mediaId
     * @return $this
     */
    public function setMediaId($mediaId)
    {
        $this->requestParameters['MediaId'] = $mediaId;
        $this->queryParameters['MediaId'] = $mediaId;

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
}
