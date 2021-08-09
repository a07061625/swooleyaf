<?php

namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RegisterMedia
 *
 * @method string getResourceOwnerId()
 * @method string getUserData()
 * @method string getRegisterMetadatas()
 * @method string getWorkflowId()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerId()
 * @method string getTemplateGroupId()
 */
class MediaRegisterRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'RegisterMedia', 'vod');
    }

    /**
     * @param string $resourceOwnerId
     *
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
     *
     * @return $this
     */
    public function setUserData($userData)
    {
        $this->requestParameters['UserData'] = $userData;
        $this->queryParameters['UserData'] = $userData;

        return $this;
    }

    /**
     * @param string $registerMetadatas
     *
     * @return $this
     */
    public function setRegisterMetadatas($registerMetadatas)
    {
        $this->requestParameters['RegisterMetadatas'] = $registerMetadatas;
        $this->queryParameters['RegisterMetadatas'] = $registerMetadatas;

        return $this;
    }

    /**
     * @param string $workflowId
     *
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
     *
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
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $templateGroupId
     *
     * @return $this
     */
    public function setTemplateGroupId($templateGroupId)
    {
        $this->requestParameters['TemplateGroupId'] = $templateGroupId;
        $this->queryParameters['TemplateGroupId'] = $templateGroupId;

        return $this;
    }
}
