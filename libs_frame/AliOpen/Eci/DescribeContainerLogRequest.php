<?php

namespace AliOpen\Eci;

use AliOpen\Core\RpcAcsRequest;

/**
 * Class DescribeContainerLogRequest
 *
 * @author    Alibaba Cloud SDK <sdk-team@alibabacloud.com>
 * @copyright 2019 Alibaba Group
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 *
 * @see      https://github.com/aliyun/aliyun-openapi-php-sdk
 *
 * @method string getResourceOwnerId()
 * @method string getContainerName()
 * @method string getStartTime()
 * @method string getContainerGroupId()
 * @method string getResourceOwnerAccount()
 * @method string getTail()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 */
class DescribeContainerLogRequest extends RpcAcsRequest
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
        parent::__construct('Eci', '2018-08-08', 'DescribeContainerLog', 'eci', 'openAPI');
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
     * @param string $containerName
     *
     * @return $this
     */
    public function setContainerName($containerName)
    {
        $this->requestParameters['ContainerName'] = $containerName;
        $this->queryParameters['ContainerName'] = $containerName;

        return $this;
    }

    /**
     * @param string $startTime
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

        return $this;
    }

    /**
     * @param string $containerGroupId
     *
     * @return $this
     */
    public function setContainerGroupId($containerGroupId)
    {
        $this->requestParameters['ContainerGroupId'] = $containerGroupId;
        $this->queryParameters['ContainerGroupId'] = $containerGroupId;

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
     * @param string $tail
     *
     * @return $this
     */
    public function setTail($tail)
    {
        $this->requestParameters['Tail'] = $tail;
        $this->queryParameters['Tail'] = $tail;

        return $this;
    }

    /**
     * @param string $ownerAccount
     *
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
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
