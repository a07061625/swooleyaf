<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getProduct()
 * @method string getModelId()
 * @method string getProjectId()
 * @method string getModelVersion()
 */
class GetModel extends Rpc
{
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
    public function withModelId($value)
    {
        $this->data['ModelId'] = $value;
        $this->options['form_params']['ModelId'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelVersion($value)
    {
        $this->data['ModelVersion'] = $value;
        $this->options['form_params']['ModelVersion'] = $value;

        return $this;
    }
}
