<?php

namespace AliOpen\AliDNS;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AddGtmAddressPool
 *
 * @method string getMonitorExtendInfo()
 * @method string getType()
 * @method string getTimeout()
 * @method string getMinAvailableAddrNum()
 * @method string getEvaluationCount()
 * @method string getLang()
 * @method array getAddrs()
 * @method string getMonitorStatus()
 * @method string getInstanceId()
 * @method string getUserClientIp()
 * @method string getName()
 * @method string getProtocolType()
 * @method string getInterval()
 * @method array getIspCityNodes()
 */
class AddGtmAddressPoolRequest extends RpcAcsRequest
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
            'AddGtmAddressPool',
            'alidns'
        );
    }

    /**
     * @param string $monitorExtendInfo
     *
     * @return $this
     */
    public function setMonitorExtendInfo($monitorExtendInfo)
    {
        $this->requestParameters['MonitorExtendInfo'] = $monitorExtendInfo;
        $this->queryParameters['MonitorExtendInfo'] = $monitorExtendInfo;

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

    /**
     * @param string $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->requestParameters['Timeout'] = $timeout;
        $this->queryParameters['Timeout'] = $timeout;

        return $this;
    }

    /**
     * @param string $minAvailableAddrNum
     *
     * @return $this
     */
    public function setMinAvailableAddrNum($minAvailableAddrNum)
    {
        $this->requestParameters['MinAvailableAddrNum'] = $minAvailableAddrNum;
        $this->queryParameters['MinAvailableAddrNum'] = $minAvailableAddrNum;

        return $this;
    }

    /**
     * @param string $evaluationCount
     *
     * @return $this
     */
    public function setEvaluationCount($evaluationCount)
    {
        $this->requestParameters['EvaluationCount'] = $evaluationCount;
        $this->queryParameters['EvaluationCount'] = $evaluationCount;

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
     * @return $this
     */
    public function setAddrs(array $addr)
    {
        $this->requestParameters['Addrs'] = $addr;
        foreach ($addr as $depth1 => $depth1Value) {
            $this->queryParameters['Addr.' . ($depth1 + 1) . '.Mode'] = $depth1Value['Mode'];
            $this->queryParameters['Addr.' . ($depth1 + 1) . '.LbaWeight'] = $depth1Value['LbaWeight'];
            $this->queryParameters['Addr.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
        }

        return $this;
    }

    /**
     * @param string $monitorStatus
     *
     * @return $this
     */
    public function setMonitorStatus($monitorStatus)
    {
        $this->requestParameters['MonitorStatus'] = $monitorStatus;
        $this->queryParameters['MonitorStatus'] = $monitorStatus;

        return $this;
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
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $protocolType
     *
     * @return $this
     */
    public function setProtocolType($protocolType)
    {
        $this->requestParameters['ProtocolType'] = $protocolType;
        $this->queryParameters['ProtocolType'] = $protocolType;

        return $this;
    }

    /**
     * @param string $interval
     *
     * @return $this
     */
    public function setInterval($interval)
    {
        $this->requestParameters['Interval'] = $interval;
        $this->queryParameters['Interval'] = $interval;

        return $this;
    }

    /**
     * @return $this
     */
    public function setIspCityNodes(array $ispCityNode)
    {
        $this->requestParameters['IspCityNodes'] = $ispCityNode;
        foreach ($ispCityNode as $depth1 => $depth1Value) {
            $this->queryParameters['IspCityNode.' . ($depth1 + 1) . '.CityCode'] = $depth1Value['CityCode'];
            $this->queryParameters['IspCityNode.' . ($depth1 + 1) . '.IspCode'] = $depth1Value['IspCode'];
        }

        return $this;
    }
}
