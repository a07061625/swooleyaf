<?php

namespace AliOpen\AliDNS;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeGtmInstance
 *
 * @method string getInstanceId()
 * @method string getUserClientIp()
 * @method string getLang()
 * @method string getNeedDetailAttributes()
 */
class DescribeGtmInstanceRequest extends RpcAcsRequest
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
            'DescribeGtmInstance',
            'alidns'
        );
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

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

    /**
     * @param string $needDetailAttributes
     *
     * @return $this
     */
    public function setNeedDetailAttributes($needDetailAttributes)
    {
        $this->requestParameters['NeedDetailAttributes'] = $needDetailAttributes;
        $this->queryParameters['NeedDetailAttributes'] = $needDetailAttributes;

        return $this;
    }
}
