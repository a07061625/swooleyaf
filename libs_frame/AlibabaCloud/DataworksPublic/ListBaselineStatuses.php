<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getSearchText()
 * @method string getOwner()
 * @method string getPriority()
 * @method string getPageNumber()
 * @method string getTopicId()
 * @method string getBizdate()
 * @method string getFinishStatus()
 * @method string getPageSize()
 * @method string getBaselineTypes()
 * @method string getStatus()
 */
class ListBaselineStatuses extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSearchText($value)
    {
        $this->data['SearchText'] = $value;
        $this->options['form_params']['SearchText'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOwner($value)
    {
        $this->data['Owner'] = $value;
        $this->options['form_params']['Owner'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPriority($value)
    {
        $this->data['Priority'] = $value;
        $this->options['form_params']['Priority'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTopicId($value)
    {
        $this->data['TopicId'] = $value;
        $this->options['form_params']['TopicId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizdate($value)
    {
        $this->data['Bizdate'] = $value;
        $this->options['form_params']['Bizdate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFinishStatus($value)
    {
        $this->data['FinishStatus'] = $value;
        $this->options['form_params']['FinishStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBaselineTypes($value)
    {
        $this->data['BaselineTypes'] = $value;
        $this->options['form_params']['BaselineTypes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['form_params']['Status'] = $value;

        return $this;
    }
}
