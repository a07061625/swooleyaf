<?php
namespace AliOpen\Afs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCaptchaRisk
 * @method string getSourceIp()
 * @method string getConfigName()
 * @method string getRefExtId()
 * @method string getTime()
 */
class CaptchaRiskDescribeRequest extends RpcAcsRequest
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
        parent::__construct('afs', '2018-01-12', 'DescribeCaptchaRisk', 'afs');
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

    /**
     * @param string $configName
     * @return $this
     */
    public function setConfigName($configName)
    {
        $this->requestParameters['ConfigName'] = $configName;
        $this->queryParameters['ConfigName'] = $configName;

        return $this;
    }

    /**
     * @param string $refExtId
     * @return $this
     */
    public function setRefExtId($refExtId)
    {
        $this->requestParameters['RefExtId'] = $refExtId;
        $this->queryParameters['RefExtId'] = $refExtId;

        return $this;
    }

    /**
     * @param string $time
     * @return $this
     */
    public function setTime($time)
    {
        $this->requestParameters['Time'] = $time;
        $this->queryParameters['Time'] = $time;

        return $this;
    }
}
