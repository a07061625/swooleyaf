<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getIsIncrementalTrain()
 * @method string getModelName()
 * @method string getDatasetIdList()
 * @method string getTestDatasetIdList()
 * @method string getModelType()
 * @method string getProjectId()
 * @method string getProduct()
 * @method string getModelId()
 */
class CreateModel extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsIncrementalTrain($value)
    {
        $this->data['IsIncrementalTrain'] = $value;
        $this->options['form_params']['IsIncrementalTrain'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelName($value)
    {
        $this->data['ModelName'] = $value;
        $this->options['form_params']['ModelName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDatasetIdList($value)
    {
        $this->data['DatasetIdList'] = $value;
        $this->options['form_params']['DatasetIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTestDatasetIdList($value)
    {
        $this->data['TestDatasetIdList'] = $value;
        $this->options['form_params']['TestDatasetIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelType($value)
    {
        $this->data['ModelType'] = $value;
        $this->options['form_params']['ModelType'] = $value;

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
}
