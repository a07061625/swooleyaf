<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getIsoId()
 * @method $this withIsoId($value)
 * @method string getApiPath()
 * @method $this withApiPath($value)
 * @method array getCondition()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class ListAnalyticsData extends Rpc
{
    /**
     * @return $this
     */
    public function withCondition(array $condition)
    {
        $this->data['Condition'] = $condition;
        foreach ($condition as $depth1 => $depth1Value) {
            if (isset($depth1Value['FieldName'])) {
                $this->options['query']['Condition.' . ($depth1 + 1) . '.FieldName'] = $depth1Value['FieldName'];
            }
            if (isset($depth1Value['Operate'])) {
                $this->options['query']['Condition.' . ($depth1 + 1) . '.Operate'] = $depth1Value['Operate'];
            }
            if (isset($depth1Value['BetweenStart'])) {
                $this->options['query']['Condition.' . ($depth1 + 1) . '.BetweenStart'] = $depth1Value['BetweenStart'];
            }
            if (isset($depth1Value['BetweenEnd'])) {
                $this->options['query']['Condition.' . ($depth1 + 1) . '.BetweenEnd'] = $depth1Value['BetweenEnd'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Condition.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
