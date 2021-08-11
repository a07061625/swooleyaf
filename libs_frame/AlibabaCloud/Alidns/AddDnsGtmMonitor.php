<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getMonitorExtendInfo()
 * @method $this withMonitorExtendInfo($value)
 * @method string getTimeout()
 * @method $this withTimeout($value)
 * @method string getAddrPoolId()
 * @method $this withAddrPoolId($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getEvaluationCount()
 * @method $this withEvaluationCount($value)
 * @method string getProtocolType()
 * @method $this withProtocolType($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method array getIspCityNode()
 */
class AddDnsGtmMonitor extends Rpc
{
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
