<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeEarlyWarning
 * @method string getSourceIp()
 */
class EarlyWarningDescribeRequest extends RpcAcsRequest
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
        parent::__construct('afs', '2018-01-12', 'DescribeEarlyWarning', 'afs');
    }

    /**
     * @param string $sourceIp
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }
}
