<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getType()
 * @method string getPageNumber()
 * @method string getCountTotalNum()
 * @method string getAppName()
 * @method string getNameSpace()
 * @method string getPageSize()
 * @method string getNameLike()
 */
class PaginateProject extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['form_params']['Type'] = $value;

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
    public function withCountTotalNum($value)
    {
        $this->data['CountTotalNum'] = $value;
        $this->options['form_params']['CountTotalNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppName($value)
    {
        $this->data['AppName'] = $value;
        $this->options['form_params']['AppName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNameSpace($value)
    {
        $this->data['NameSpace'] = $value;
        $this->options['form_params']['NameSpace'] = $value;

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
    public function withNameLike($value)
    {
        $this->data['NameLike'] = $value;
        $this->options['form_params']['NameLike'] = $value;

        return $this;
    }
}
