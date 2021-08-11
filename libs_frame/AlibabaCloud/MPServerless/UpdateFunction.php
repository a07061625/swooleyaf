<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getMemory()
 * @method string getRuntime()
 * @method string getTimeout()
 * @method string getCustomVariables()
 * @method string getSpaceId()
 * @method string getFunctionId()
 * @method string getFunctionDesc()
 */
class UpdateFunction extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMemory($value)
    {
        $this->data['Memory'] = $value;
        $this->options['form_params']['Memory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRuntime($value)
    {
        $this->data['Runtime'] = $value;
        $this->options['form_params']['Runtime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTimeout($value)
    {
        $this->data['Timeout'] = $value;
        $this->options['form_params']['Timeout'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCustomVariables($value)
    {
        $this->data['CustomVariables'] = $value;
        $this->options['form_params']['CustomVariables'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpaceId($value)
    {
        $this->data['SpaceId'] = $value;
        $this->options['form_params']['SpaceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFunctionId($value)
    {
        $this->data['FunctionId'] = $value;
        $this->options['form_params']['FunctionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFunctionDesc($value)
    {
        $this->data['FunctionDesc'] = $value;
        $this->options['form_params']['FunctionDesc'] = $value;

        return $this;
    }
}
