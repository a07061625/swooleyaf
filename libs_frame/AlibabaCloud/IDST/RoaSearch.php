<?php

namespace AlibabaCloud\IDST;

/**
 * @method string getVid()
 * @method string getApp()
 * @method string getS()
 * @method string getProductId()
 * @method string getCatId()
 * @method string getN()
 * @method string getPicName()
 */
class RoaSearch extends Roa
{
    /** @var string */
    public $pathPattern = '/bin/sp';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVid($value)
    {
        $this->data['Vid'] = $value;
        $this->options['query']['vid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApp($value)
    {
        $this->data['App'] = $value;
        $this->options['query']['app'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withS($value)
    {
        $this->data['S'] = $value;
        $this->options['query']['s'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductId($value)
    {
        $this->data['ProductId'] = $value;
        $this->options['query']['product_id'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCatId($value)
    {
        $this->data['CatId'] = $value;
        $this->options['query']['cat_id'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withN($value)
    {
        $this->data['N'] = $value;
        $this->options['query']['n'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPicName($value)
    {
        $this->data['PicName'] = $value;
        $this->options['query']['pic_name'] = $value;

        return $this;
    }
}
