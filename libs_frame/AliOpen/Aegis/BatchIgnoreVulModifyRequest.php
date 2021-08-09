<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyBatchIgnoreVul
 *
 * @method string getReason()
 * @method string getSourceIp()
 * @method string getInfo()
 */
class BatchIgnoreVulModifyRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'ModifyBatchIgnoreVul', 'vipaegis');
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
     * @param string $info
     *
     * @return $this
     */
    public function setInfo($info)
    {
        $this->requestParameters['Info'] = $info;
        $this->queryParameters['Info'] = $info;

        return $this;
    }
}
