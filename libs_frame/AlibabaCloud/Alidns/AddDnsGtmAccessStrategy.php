<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getDefaultLbaStrategy()
 * @method $this withDefaultLbaStrategy($value)
 * @method string getFailoverAddrPoolType()
 * @method $this withFailoverAddrPoolType($value)
 * @method string getDefaultAddrPoolType()
 * @method $this withDefaultAddrPoolType($value)
 * @method string getFailoverMaxReturnAddrNum()
 * @method $this withFailoverMaxReturnAddrNum($value)
 * @method string getFailoverLbaStrategy()
 * @method $this withFailoverLbaStrategy($value)
 * @method array getDefaultAddrPool()
 * @method string getFailoverMinAvailableAddrNum()
 * @method $this withFailoverMinAvailableAddrNum($value)
 * @method string getDefaultMaxReturnAddrNum()
 * @method $this withDefaultMaxReturnAddrNum($value)
 * @method string getDefaultMinAvailableAddrNum()
 * @method $this withDefaultMinAvailableAddrNum($value)
 * @method string getStrategyMode()
 * @method $this withStrategyMode($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getLines()
 * @method $this withLines($value)
 * @method string getStrategyName()
 * @method $this withStrategyName($value)
 * @method string getDefaultLatencyOptimization()
 * @method $this withDefaultLatencyOptimization($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getFailoverLatencyOptimization()
 * @method $this withFailoverLatencyOptimization($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method array getFailoverAddrPool()
 */
class AddDnsGtmAccessStrategy extends Rpc
{
    /**
     * @return $this
     */
    public function withDefaultAddrPool(array $defaultAddrPool)
    {
        $this->data['DefaultAddrPool'] = $defaultAddrPool;
        foreach ($defaultAddrPool as $depth1 => $depth1Value) {
            if (isset($depth1Value['Id'])) {
                $this->options['query']['DefaultAddrPool.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['LbaWeight'])) {
                $this->options['query']['DefaultAddrPool.' . ($depth1 + 1) . '.LbaWeight'] = $depth1Value['LbaWeight'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withFailoverAddrPool(array $failoverAddrPool)
    {
        $this->data['FailoverAddrPool'] = $failoverAddrPool;
        foreach ($failoverAddrPool as $depth1 => $depth1Value) {
            if (isset($depth1Value['Id'])) {
                $this->options['query']['FailoverAddrPool.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['LbaWeight'])) {
                $this->options['query']['FailoverAddrPool.' . ($depth1 + 1) . '.LbaWeight'] = $depth1Value['LbaWeight'];
            }
        }

        return $this;
    }
}
