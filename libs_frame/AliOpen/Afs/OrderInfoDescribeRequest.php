<?php

namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeOrderInfo
 *
 * @method string getSourceIp()
 */
class OrderInfoDescribeRequest extends RpcAcsRequest
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
        parent::__construct('afs', '2018-01-12', 'DescribeOrderInfo', 'afs');
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
}
