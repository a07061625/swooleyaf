<?php

namespace AliOpen\SasApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeAccountProfileByKey
 *
 * @method string getSourceIp()
 * @method string getKeyword()
 */
class DescribeAccountProfileByKeyRequest extends RpcAcsRequest
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
        parent::__construct('Sas-api', '2017-07-05', 'DescribeAccountProfileByKey', 'sas-api');
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
     * @param string $keyword
     *
     * @return $this
     */
    public function setKeyword($keyword)
    {
        $this->requestParameters['Keyword'] = $keyword;
        $this->queryParameters['Keyword'] = $keyword;

        return $this;
    }
}
