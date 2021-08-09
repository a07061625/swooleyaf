<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyAutoDelConfig
 *
 * @method string getSourceIp()
 * @method string getDays()
 */
class AutoDelConfigModifyRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'ModifyAutoDelConfig', 'vipaegis');
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
     * @param string $days
     *
     * @return $this
     */
    public function setDays($days)
    {
        $this->requestParameters['Days'] = $days;
        $this->queryParameters['Days'] = $days;

        return $this;
    }
}
