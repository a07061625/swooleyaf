<?php

namespace AliOpen\AliDNS;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCustomLine
 *
 * @method string getLineId()
 * @method string getUserClientIp()
 * @method string getLang()
 */
class DescribeCustomLineRequest extends RpcAcsRequest
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
        parent::__construct(
            'Alidns',
            '2015-01-09',
            'DescribeCustomLine',
            'alidns'
        );
    }

    /**
     * @param string $lineId
     *
     * @return $this
     */
    public function setLineId($lineId)
    {
        $this->requestParameters['LineId'] = $lineId;
        $this->queryParameters['LineId'] = $lineId;

        return $this;
    }

    /**
     * @param string $userClientIp
     *
     * @return $this
     */
    public function setUserClientIp($userClientIp)
    {
        $this->requestParameters['UserClientIp'] = $userClientIp;
        $this->queryParameters['UserClientIp'] = $userClientIp;

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
