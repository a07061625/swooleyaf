<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListCpfsFileSystems
 * @method string getPageSize()
 * @method string getPageNumber()
 * @method string getFileSystemId()
 */
class ListCpfsFileSystemsRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'ListCpfsFileSystems', 'ehs');
    }

    /**
     * @param string $pageSize
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
     * @return $this
     */
    public function setFileSystemId($fileSystemId)
    {
        $this->requestParameters['FileSystemId'] = $fileSystemId;
        $this->queryParameters['FileSystemId'] = $fileSystemId;

        return $this;
    }
}
