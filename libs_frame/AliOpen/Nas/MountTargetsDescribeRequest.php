<?php

namespace AliOpen\Nas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeMountTargets
 *
 * @method string getMountTargetDomain()
 * @method string getPageSize()
 * @method string getPageNumber()
 * @method string getFileSystemId()
 */
class MountTargetsDescribeRequest extends RpcAcsRequest
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
        parent::__construct('NAS', '2017-06-26', 'DescribeMountTargets', 'nas');
    }

    /**
     * @param string $mountTargetDomain
     *
     * @return $this
     */
    public function setMountTargetDomain($mountTargetDomain)
    {
        $this->requestParameters['MountTargetDomain'] = $mountTargetDomain;
        $this->queryParameters['MountTargetDomain'] = $mountTargetDomain;

        return $this;
    }

    /**
     * @param string $pageSize
     *
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->requestParameters['PageSize'] = $pageSize;
        $this->queryParameters['PageSize'] = $pageSize;

        return $this;
    }

    /**
     * @param string $pageNumber
     *
     * @return $this
     */
    public function setPageNumber($pageNumber)
    {
        $this->requestParameters['PageNumber'] = $pageNumber;
        $this->queryParameters['PageNumber'] = $pageNumber;

        return $this;
    }

    /**
     * @param string $fileSystemId
     *
     * @return $this
     */
    public function setFileSystemId($fileSystemId)
    {
        $this->requestParameters['FileSystemId'] = $fileSystemId;
        $this->queryParameters['FileSystemId'] = $fileSystemId;

        return $this;
    }
}
