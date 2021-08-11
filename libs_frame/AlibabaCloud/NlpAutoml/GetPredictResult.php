<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getTopK()
 * @method string getProduct()
 * @method string getModelId()
 * @method string getDetailTag()
 * @method string getContent()
 * @method string getModelVersion()
 */
class GetPredictResult extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTopK($value)
    {
        $this->data['TopK'] = $value;
        $this->options['form_params']['TopK'] = $value;

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
    public function withDetailTag($value)
    {
        $this->data['DetailTag'] = $value;
        $this->options['form_params']['DetailTag'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

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
