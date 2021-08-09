<?php

namespace AliOpen\Edas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of BindSlb
 *
 * @method string getVServerGroupId()
 * @method string getListenerPort()
 * @method string getSlbId()
 * @method string getAppId()
 * @method string getSlbIp()
 * @method string getType()
 */
class BindSlbRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/pop/app/bind_slb_json';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Edas', '2017-08-01', 'BindSlb');
    }

    /**
     * @param string $vServerGroupId
     *
     * @return $this
     */
    public function setVServerGroupId($vServerGroupId)
    {
        $this->requestParameters['VServerGroupId'] = $vServerGroupId;
        $this->queryParameters['VServerGroupId'] = $vServerGroupId;

        return $this;
    }

    /**
     * @param string $listenerPort
     *
     * @return $this
     */
    public function setListenerPort($listenerPort)
    {
        $this->requestParameters['ListenerPort'] = $listenerPort;
        $this->queryParameters['ListenerPort'] = $listenerPort;

        return $this;
    }

    /**
     * @param string $slbId
     *
     * @return $this
     */
    public function setSlbId($slbId)
    {
        $this->requestParameters['SlbId'] = $slbId;
        $this->queryParameters['SlbId'] = $slbId;

        return $this;
    }

    /**
     * @param string $appId
     *
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->requestParameters['AppId'] = $appId;
        $this->queryParameters['AppId'] = $appId;

        return $this;
    }

    /**
     * @param string $slbIp
     *
     * @return $this
     */
    public function setSlbIp($slbIp)
    {
        $this->requestParameters['SlbIp'] = $slbIp;
        $this->queryParameters['SlbIp'] = $slbIp;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->requestParameters['Type'] = $type;
        $this->queryParameters['Type'] = $type;

        return $this;
    }
}
