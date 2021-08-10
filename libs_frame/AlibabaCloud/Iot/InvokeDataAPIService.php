<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getParam()
 * @method string getIotInstanceId()
 * @method string getApiSrn()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class InvokeDataAPIService extends Rpc
{
    /**
     * @return $this
     */
    public function withParam(array $param)
    {
        $this->data['Param'] = $param;
        foreach ($param as $depth1 => $depth1Value) {
            if (isset($depth1Value['ParamType'])) {
                $this->options['form_params']['Param.' . ($depth1 + 1) . '.ParamType'] = $depth1Value['ParamType'];
            }
            foreach ($depth1Value['ListParamValue'] as $i => $iValue) {
                $this->options['form_params']['Param.' . ($depth1 + 1) . '.ListParamValue.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['ListParamType'])) {
                $this->options['form_params']['Param.' . ($depth1 + 1) . '.ListParamType'] = $depth1Value['ListParamType'];
            }
            if (isset($depth1Value['ParamName'])) {
                $this->options['form_params']['Param.' . ($depth1 + 1) . '.ParamName'] = $depth1Value['ParamName'];
            }
            if (isset($depth1Value['ParamValue'])) {
                $this->options['form_params']['Param.' . ($depth1 + 1) . '.ParamValue'] = $depth1Value['ParamValue'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotInstanceId($value)
    {
        $this->data['IotInstanceId'] = $value;
        $this->options['form_params']['IotInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiSrn($value)
    {
        $this->data['ApiSrn'] = $value;
        $this->options['form_params']['ApiSrn'] = $value;

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
