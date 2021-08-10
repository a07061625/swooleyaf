<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getExtraParams()
 * @method string getStoreId()
 * @method string getPageNumber()
 * @method string getItemId()
 * @method string getPageSize()
 * @method string getItemBarCode()
 * @method string getBePromotion()
 * @method string getItemTitle()
 * @method string getSkuId()
 */
class DescribeItems extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

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
    public function withItemId($value)
    {
        $this->data['ItemId'] = $value;
        $this->options['form_params']['ItemId'] = $value;

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
    public function withItemBarCode($value)
    {
        $this->data['ItemBarCode'] = $value;
        $this->options['form_params']['ItemBarCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBePromotion($value)
    {
        $this->data['BePromotion'] = $value;
        $this->options['form_params']['BePromotion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withItemTitle($value)
    {
        $this->data['ItemTitle'] = $value;
        $this->options['form_params']['ItemTitle'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSkuId($value)
    {
        $this->data['SkuId'] = $value;
        $this->options['form_params']['SkuId'] = $value;

        return $this;
    }
}
