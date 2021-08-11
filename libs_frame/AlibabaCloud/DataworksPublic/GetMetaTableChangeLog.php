<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getStartDate()
 * @method string getPageNumber()
 * @method string getEndDate()
 * @method string getTableGuid()
 * @method string getChangeType()
 * @method string getPageSize()
 * @method string getObjectType()
 */
class GetMetaTableChangeLog extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartDate($value)
    {
        $this->data['StartDate'] = $value;
        $this->options['form_params']['StartDate'] = $value;

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
    public function withEndDate($value)
    {
        $this->data['EndDate'] = $value;
        $this->options['form_params']['EndDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTableGuid($value)
    {
        $this->data['TableGuid'] = $value;
        $this->options['form_params']['TableGuid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChangeType($value)
    {
        $this->data['ChangeType'] = $value;
        $this->options['form_params']['ChangeType'] = $value;

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
    public function withObjectType($value)
    {
        $this->data['ObjectType'] = $value;
        $this->options['form_params']['ObjectType'] = $value;

        return $this;
    }
}
