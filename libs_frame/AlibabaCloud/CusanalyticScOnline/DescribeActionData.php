<?php

namespace AlibabaCloud\CusanalyticScOnline;

/**
 * @method string getTsEnd()
 * @method string getStoreId()
 * @method string getPageLimit()
 * @method string getPageNo()
 * @method string getTsStart()
 */
class DescribeActionData extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTsEnd($value)
    {
        $this->data['TsEnd'] = $value;
        $this->options['form_params']['TsEnd'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreId($value)
    {
        $this->data['StoreId'] = $value;
        $this->options['form_params']['StoreId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageLimit($value)
    {
        $this->data['PageLimit'] = $value;
        $this->options['form_params']['PageLimit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNo($value)
    {
        $this->data['PageNo'] = $value;
        $this->options['form_params']['PageNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTsStart($value)
    {
        $this->data['TsStart'] = $value;
        $this->options['form_params']['TsStart'] = $value;

        return $this;
    }
}
