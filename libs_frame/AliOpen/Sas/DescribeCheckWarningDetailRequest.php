<?php

namespace AliOpen\Sas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCheckWarningDetail
 * @method string getSourceIp()
 * @method string getLang()
 * @method string getCheckWarningId()
 */
class DescribeCheckWarningDetailRequest extends RpcAcsRequest
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
        parent::__construct('Sas', '2018-12-03', 'DescribeCheckWarningDetail', 'sas');
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
     * @param string $lang
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }

    /**
     * @param string $checkWarningId
     * @return $this
     */
    public function setCheckWarningId($checkWarningId)
    {
        $this->requestParameters['CheckWarningId'] = $checkWarningId;
        $this->queryParameters['CheckWarningId'] = $checkWarningId;

        return $this;
    }
}
