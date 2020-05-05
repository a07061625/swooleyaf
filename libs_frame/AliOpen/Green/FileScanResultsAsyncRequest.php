<?php
namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of FileAsyncScanResults
 * @method string getClientInfo()
 */
class FileScanResultsAsyncRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/file/results';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'FileAsyncScanResults', 'green');
    }

    /**
     * @param string $clientInfo
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
