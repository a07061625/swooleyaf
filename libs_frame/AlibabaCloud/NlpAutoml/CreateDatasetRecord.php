<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getDatasetRecord()
 * @method string getDatasetId()
 * @method string getProjectId()
 */
class CreateDatasetRecord extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDatasetRecord($value)
    {
        $this->data['DatasetRecord'] = $value;
        $this->options['form_params']['DatasetRecord'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDatasetId($value)
    {
        $this->data['DatasetId'] = $value;
        $this->options['form_params']['DatasetId'] = $value;

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
