<?php

namespace AlibabaCloud\CusanalyticScOnline;

/**
 * @method string getEndUVCount()
 * @method string getParentAmount()
 * @method string getStartDate()
 * @method string getStartUVCount()
 * @method string getStoreId()
 * @method string getEndDate()
 * @method string getLocationId()
 * @method string getParentLocationIds()
 */
class GetAnalyzePlaceData extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndUVCount($value)
    {
        $this->data['EndUVCount'] = $value;
        $this->options['form_params']['EndUVCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParentAmount($value)
    {
        $this->data['ParentAmount'] = $value;
        $this->options['form_params']['ParentAmount'] = $value;

        return $this;
    }

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
    public function withStartUVCount($value)
    {
        $this->data['StartUVCount'] = $value;
        $this->options['form_params']['StartUVCount'] = $value;

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
    public function withLocationId($value)
    {
        $this->data['LocationId'] = $value;
        $this->options['form_params']['LocationId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParentLocationIds($value)
    {
        $this->data['ParentLocationIds'] = $value;
        $this->options['form_params']['ParentLocationIds'] = $value;

        return $this;
    }
}
