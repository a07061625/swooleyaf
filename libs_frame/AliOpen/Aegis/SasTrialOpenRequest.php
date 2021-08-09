<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OpenSasTrial
 *
 * @method string getSourceIp()
 * @method string getBuyVersion()
 */
class SasTrialOpenRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'OpenSasTrial', 'vipaegis');
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
     * @param string $buyVersion
     *
     * @return $this
     */
    public function setBuyVersion($buyVersion)
    {
        $this->requestParameters['BuyVersion'] = $buyVersion;
        $this->queryParameters['BuyVersion'] = $buyVersion;

        return $this;
    }
}
