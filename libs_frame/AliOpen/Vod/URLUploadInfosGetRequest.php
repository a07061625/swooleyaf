<?php

namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetURLUploadInfos
 *
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerId()
 * @method string getJobIds()
 * @method string getUploadURLs()
 */
class URLUploadInfosGetRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'GetURLUploadInfos', 'vod');
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
     * @param string $jobIds
     *
     * @return $this
     */
    public function setJobIds($jobIds)
    {
        $this->requestParameters['JobIds'] = $jobIds;
        $this->queryParameters['JobIds'] = $jobIds;

        return $this;
    }

    /**
     * @param string $uploadURLs
     *
     * @return $this
     */
    public function setUploadURLs($uploadURLs)
    {
        $this->requestParameters['UploadURLs'] = $uploadURLs;
        $this->queryParameters['UploadURLs'] = $uploadURLs;

        return $this;
    }
}
