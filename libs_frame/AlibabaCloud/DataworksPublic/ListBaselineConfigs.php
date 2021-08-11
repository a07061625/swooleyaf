<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getOwner()
 * @method string getSearchText()
 * @method string getUseflag()
 * @method string getPriority()
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getProjectId()
 * @method string getBaselineTypes()
 */
class ListBaselineConfigs extends Rpc
{
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
    public function withUseflag($value)
    {
        $this->data['Useflag'] = $value;
        $this->options['form_params']['Useflag'] = $value;

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
    public function withBaselineTypes($value)
    {
        $this->data['BaselineTypes'] = $value;
        $this->options['form_params']['BaselineTypes'] = $value;

        return $this;
    }
}
