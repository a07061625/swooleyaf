<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getMonitorExtendInfo()
 * @method $this withMonitorExtendInfo($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getTimeout()
 * @method $this withTimeout($value)
 * @method string getMinAvailableAddrNum()
 * @method $this withMinAvailableAddrNum($value)
 * @method string getEvaluationCount()
 * @method $this withEvaluationCount($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method array getAddr()
 * @method string getMonitorStatus()
 * @method $this withMonitorStatus($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getProtocolType()
 * @method $this withProtocolType($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 * @method array getIspCityNode()
 */
class AddGtmAddressPool extends Rpc
{
    /**
     * @return $this
     */
    public function withAddr(array $addr)
    {
        $this->data['Addr'] = $addr;
        foreach ($addr as $depth1 => $depth1Value) {
            if (isset($depth1Value['Mode'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.Mode'] = $depth1Value['Mode'];
            }
            if (isset($depth1Value['LbaWeight'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.LbaWeight'] = $depth1Value['LbaWeight'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withIspCityNode(array $ispCityNode)
    {
        $this->data['IspCityNode'] = $ispCityNode;
        foreach ($ispCityNode as $depth1 => $depth1Value) {
            if (isset($depth1Value['CityCode'])) {
                $this->options['query']['IspCityNode.' . ($depth1 + 1) . '.CityCode'] = $depth1Value['CityCode'];
            }
            if (isset($depth1Value['IspCode'])) {
                $this->options['query']['IspCityNode.' . ($depth1 + 1) . '.IspCode'] = $depth1Value['IspCode'];
            }
        }

        return $this;
    }
}
