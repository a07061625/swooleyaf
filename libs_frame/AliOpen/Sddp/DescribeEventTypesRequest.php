<?php

namespace AliOpen\Sddp;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeEventTypes
 *
 * @method string getSourceIp()
 * @method string getParentTypeId()
 * @method string getLang()
 */
class DescribeEventTypesRequest extends RpcAcsRequest
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
        parent::__construct('Sddp', '2019-01-03', 'DescribeEventTypes', 'sddp');
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
     * @param string $parentTypeId
     *
     * @return $this
     */
    public function setParentTypeId($parentTypeId)
    {
        $this->requestParameters['ParentTypeId'] = $parentTypeId;
        $this->queryParameters['ParentTypeId'] = $parentTypeId;

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
}
