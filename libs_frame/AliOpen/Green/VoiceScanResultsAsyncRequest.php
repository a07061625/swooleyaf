<?php

namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of VoiceAsyncScanResults
 *
 * @method string getClientInfo()
 */
class VoiceScanResultsAsyncRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/voice/results';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'VoiceAsyncScanResults', 'green');
    }

    /**
     * @param string $clientInfo
     *
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
