<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getProjectName()
 * @method string getProduct()
 * @method string getProjectDescription()
 * @method string getProjectType()
 */
class CreateProject extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->options['form_params']['ProjectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProduct($value)
    {
        $this->data['Product'] = $value;
        $this->options['form_params']['Product'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectDescription($value)
    {
        $this->data['ProjectDescription'] = $value;
        $this->options['form_params']['ProjectDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectType($value)
    {
        $this->data['ProjectType'] = $value;
        $this->options['form_params']['ProjectType'] = $value;

        return $this;
    }
}
