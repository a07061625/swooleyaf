<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getCoType()
 * @method string getAppId()
 * @method string getPageSize()
 * @method string getCurrentPage()
 * @method string getCoStatus()
 * @method string getKey()
 */
class ListChangeOrders extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/changeorder/ListChangeOrders';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCoType($value)
    {
        $this->data['CoType'] = $value;
        $this->options['query']['CoType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

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
        $this->options['query']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCurrentPage($value)
    {
        $this->data['CurrentPage'] = $value;
        $this->options['query']['CurrentPage'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCoStatus($value)
    {
        $this->data['CoStatus'] = $value;
        $this->options['query']['CoStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withKey($value)
    {
        $this->data['Key'] = $value;
        $this->options['query']['Key'] = $value;

        return $this;
    }
}
