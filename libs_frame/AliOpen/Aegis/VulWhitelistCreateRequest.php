<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateVulWhitelist
 *
 * @method string getReason()
 * @method string getSourceIp()
 * @method string getWhitelist()
 */
class VulWhitelistCreateRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'CreateVulWhitelist', 'vipaegis');
    }

    /**
     * @param string $reason
     *
     * @return $this
     */
    public function setReason($reason)
    {
        $this->requestParameters['Reason'] = $reason;
        $this->queryParameters['Reason'] = $reason;

        return $this;
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $whitelist
     *
     * @return $this
     */
    public function setWhitelist($whitelist)
    {
        $this->requestParameters['Whitelist'] = $whitelist;
        $this->queryParameters['Whitelist'] = $whitelist;

        return $this;
    }
}
