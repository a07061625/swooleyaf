<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getProduct()
 * @method string getPredictContent()
 * @method string getServiceVersion()
 * @method string getServiceName()
 */
class RunPreTrainService extends Rpc
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
    public function withPredictContent($value)
    {
        $this->data['PredictContent'] = $value;
        $this->options['form_params']['PredictContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceVersion($value)
    {
        $this->data['ServiceVersion'] = $value;
        $this->options['form_params']['ServiceVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceName($value)
    {
        $this->data['ServiceName'] = $value;
        $this->options['form_params']['ServiceName'] = $value;

        return $this;
    }
}
