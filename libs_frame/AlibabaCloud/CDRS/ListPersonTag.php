<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getSchema()
 * @method string getCorpId()
 * @method string getPageNumber()
 * @method string getTagCode()
 * @method string getPageSize()
 */
class ListPersonTag extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchema($value)
    {
        $this->data['Schema'] = $value;
        $this->options['form_params']['Schema'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

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
    public function withTagCode($value)
    {
        $this->data['TagCode'] = $value;
        $this->options['form_params']['TagCode'] = $value;

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
}
