<?php

namespace AlibabaCloud\Drds;

/**
 * @method string getParamLevel()
 * @method $this withParamLevel($value)
 * @method array getData()
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 */
class SetupDrdsParams extends Rpc
{
    /**
     * @return $this
     */
    public function withData(array $data)
    {
        $this->data['Data'] = $data;
        foreach ($data as $depth1 => $depth1Value) {
            if (isset($depth1Value['ParamType'])) {
                $this->options['query']['Data.' . ($depth1 + 1) . '.ParamType'] = $depth1Value['ParamType'];
            }
            if (isset($depth1Value['DbName'])) {
                $this->options['query']['Data.' . ($depth1 + 1) . '.DbName'] = $depth1Value['DbName'];
            }
            if (isset($depth1Value['ParamRanges'])) {
                $this->options['query']['Data.' . ($depth1 + 1) . '.ParamRanges'] = $depth1Value['ParamRanges'];
            }
            if (isset($depth1Value['ParamVariableName'])) {
                $this->options['query']['Data.' . ($depth1 + 1) . '.ParamVariableName'] = $depth1Value['ParamVariableName'];
            }
            if (isset($depth1Value['ParamValue'])) {
                $this->options['query']['Data.' . ($depth1 + 1) . '.ParamValue'] = $depth1Value['ParamValue'];
            }
        }

        return $this;
    }
}
