<?php

namespace AliOpen\Pvtz;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeZoneVpcTree
 *
 * @method string getUserClientIp()
 * @method string getLang()
 */
class DescribeZoneVpcTreeRequest extends RpcAcsRequest
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
        parent::__construct('pvtz', '2018-01-01', 'DescribeZoneVpcTree', 'pvtz');
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
