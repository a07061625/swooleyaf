<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getProduct()
 * @method string getDatasetName()
 * @method string getProjectId()
 */
class CreateDataset extends Rpc
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
    public function withDatasetName($value)
    {
        $this->data['DatasetName'] = $value;
        $this->options['form_params']['DatasetName'] = $value;

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
