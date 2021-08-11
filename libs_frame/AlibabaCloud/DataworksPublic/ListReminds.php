<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getSearchText()
 * @method string getFounder()
 * @method string getRemindTypes()
 * @method string getPageNumber()
 * @method string getAlertTarget()
 * @method string getPageSize()
 * @method string getNodeId()
 */
class ListReminds extends Rpc
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
    public function withFounder($value)
    {
        $this->data['Founder'] = $value;
        $this->options['form_params']['Founder'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemindTypes($value)
    {
        $this->data['RemindTypes'] = $value;
        $this->options['form_params']['RemindTypes'] = $value;

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
    public function withAlertTarget($value)
    {
        $this->data['AlertTarget'] = $value;
        $this->options['form_params']['AlertTarget'] = $value;

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
    public function withNodeId($value)
    {
        $this->data['NodeId'] = $value;
        $this->options['form_params']['NodeId'] = $value;

        return $this;
    }
}
