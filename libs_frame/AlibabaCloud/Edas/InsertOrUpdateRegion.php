<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getDebugEnable()
 * @method string getRegionTag()
 * @method string getRegionName()
 * @method string getDescription()
 * @method string getId()
 */
class InsertOrUpdateRegion extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/user_region_def';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDebugEnable($value)
    {
        $this->data['DebugEnable'] = $value;
        $this->options['query']['DebugEnable'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegionTag($value)
    {
        $this->data['RegionTag'] = $value;
        $this->options['query']['RegionTag'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegionName($value)
    {
        $this->data['RegionName'] = $value;
        $this->options['query']['RegionName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['query']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withId($value)
    {
        $this->data['Id'] = $value;
        $this->options['query']['Id'] = $value;

        return $this;
    }
}
