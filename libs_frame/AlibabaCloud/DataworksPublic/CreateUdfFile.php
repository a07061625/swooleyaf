<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getReturnValue()
 * @method string getResources()
 * @method string getFunctionType()
 * @method string getCmdDescription()
 * @method string getUdfDescription()
 * @method string getParameterDescription()
 * @method string getProjectIdentifier()
 * @method string getExample()
 * @method string getFileName()
 * @method string getClassName()
 * @method string getFileFolderPath()
 * @method string getProjectId()
 */
class CreateUdfFile extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReturnValue($value)
    {
        $this->data['ReturnValue'] = $value;
        $this->options['form_params']['ReturnValue'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResources($value)
    {
        $this->data['Resources'] = $value;
        $this->options['form_params']['Resources'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFunctionType($value)
    {
        $this->data['FunctionType'] = $value;
        $this->options['form_params']['FunctionType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCmdDescription($value)
    {
        $this->data['CmdDescription'] = $value;
        $this->options['form_params']['CmdDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUdfDescription($value)
    {
        $this->data['UdfDescription'] = $value;
        $this->options['form_params']['UdfDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParameterDescription($value)
    {
        $this->data['ParameterDescription'] = $value;
        $this->options['form_params']['ParameterDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectIdentifier($value)
    {
        $this->data['ProjectIdentifier'] = $value;
        $this->options['form_params']['ProjectIdentifier'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExample($value)
    {
        $this->data['Example'] = $value;
        $this->options['form_params']['Example'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileName($value)
    {
        $this->data['FileName'] = $value;
        $this->options['form_params']['FileName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClassName($value)
    {
        $this->data['ClassName'] = $value;
        $this->options['form_params']['ClassName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileFolderPath($value)
    {
        $this->data['FileFolderPath'] = $value;
        $this->options['form_params']['FileFolderPath'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
