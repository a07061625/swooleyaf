<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getRegionTag()
 * @method string getId()
 */
class DeleteUserDefineRegion extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/user_region_def';

    /** @var string */
    public $method = 'DELETE';

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
    public function withId($value)
    {
        $this->data['Id'] = $value;
        $this->options['query']['Id'] = $value;

        return $this;
    }
}
