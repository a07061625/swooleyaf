<?php

namespace AlibabaCloud\Client\Traits;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Filter\ClientFilter;

/**
 * Trait RegionTrait
 *
 * @package AlibabaCloud\Client\Traits
 */
trait RegionTrait
{
    /**
     * @var null|string
     */
    public $regionId;

    /**
     * @param string $regionId
     *
     * @return $this
     *
     * @throws ClientException
     */
    public function regionId($regionId)
    {
        $this->regionId = ClientFilter::regionId($regionId);

        return $this;
    }
}
