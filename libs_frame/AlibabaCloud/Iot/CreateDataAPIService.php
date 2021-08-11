<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getRequestParam()
 * @method string getIotInstanceId()
 * @method string getApiPath()
 * @method string getTemplateSql()
 * @method array getResponseParam()
 * @method string getOriginSql()
 * @method string getDisplayName()
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDesc()
 */
class CreateDataAPIService extends Rpc
{
    /**
     * @return $this
     */
    public function withRequestParam(array $requestParam)
    {
        $this->data['RequestParam'] = $requestParam;
        foreach ($requestParam as $depth1 => $depth1Value) {
            if (isset($depth1Value['Name'])) {
                $this->options['form_params']['RequestParam.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
            if (isset($depth1Value['Type'])) {
                $this->options['form_params']['RequestParam.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['Desc'])) {
                $this->options['form_params']['RequestParam.' . ($depth1 + 1) . '.Desc'] = $depth1Value['Desc'];
            }
            if (isset($depth1Value['Example'])) {
                $this->options['form_params']['RequestParam.' . ($depth1 + 1) . '.Example'] = $depth1Value['Example'];
            }
            if (isset($depth1Value['Required'])) {
                $this->options['form_params']['RequestParam.' . ($depth1 + 1) . '.Required'] = $depth1Value['Required'];
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
    public function withApiPath($value)
    {
        $this->data['ApiPath'] = $value;
        $this->options['form_params']['ApiPath'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTemplateSql($value)
    {
        $this->data['TemplateSql'] = $value;
        $this->options['form_params']['TemplateSql'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withResponseParam(array $responseParam)
    {
        $this->data['ResponseParam'] = $responseParam;
        foreach ($responseParam as $depth1 => $depth1Value) {
            if (isset($depth1Value['Name'])) {
                $this->options['form_params']['ResponseParam.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
            if (isset($depth1Value['Type'])) {
                $this->options['form_params']['ResponseParam.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['Desc'])) {
                $this->options['form_params']['ResponseParam.' . ($depth1 + 1) . '.Desc'] = $depth1Value['Desc'];
            }
            if (isset($depth1Value['Example'])) {
                $this->options['form_params']['ResponseParam.' . ($depth1 + 1) . '.Example'] = $depth1Value['Example'];
            }
            if (isset($depth1Value['Required'])) {
                $this->options['form_params']['ResponseParam.' . ($depth1 + 1) . '.Required'] = $depth1Value['Required'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOriginSql($value)
    {
        $this->data['OriginSql'] = $value;
        $this->options['form_params']['OriginSql'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDisplayName($value)
    {
        $this->data['DisplayName'] = $value;
        $this->options['form_params']['DisplayName'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDesc($value)
    {
        $this->data['Desc'] = $value;
        $this->options['form_params']['Desc'] = $value;

        return $this;
    }
}
