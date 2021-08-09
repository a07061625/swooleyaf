<?php

namespace AliOpen\JarVis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeSpecialEcs
 *
 * @method string getTargetIp()
 * @method string getSourceIp()
 * @method string getLang()
 * @method string getSourceCode()
 */
class DescribeSpecialEcsRequest extends RpcAcsRequest
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
        parent::__construct('jarvis', '2018-02-06', 'DescribeSpecialEcs', 'jarvis');
    }

    /**
     * @param string $targetIp
     *
     * @return $this
     */
    public function setTargetIp($targetIp)
    {
        $this->requestParameters['TargetIp'] = $targetIp;
        $this->queryParameters['TargetIp'] = $targetIp;

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
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }

    /**
     * @param string $sourceCode
     *
     * @return $this
     */
    public function setSourceCode($sourceCode)
    {
        $this->requestParameters['SourceCode'] = $sourceCode;
        $this->queryParameters['SourceCode'] = $sourceCode;

        return $this;
    }
}
