<?php

namespace AlibabaCloud\Client\Traits;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Filter\ClientFilter;

/**
 * Trait DefaultRegionTrait
 *
 * @package   AlibabaCloud\Client\Traits
 * @mixin     AlibabaCloud
 */
trait DefaultRegionTrait
{
    /**
     * @var null|string Default RegionId
     */
    protected static $defaultRegionId;

    /**
     * @param $regionId
     *
     * @throws ClientException
     *
     * @deprecated
     * @codeCoverageIgnore
     */
    public static function setGlobalRegionId($regionId)
    {
        self::setDefaultRegionId($regionId);
    }

    /**
     * @return null|string
     *
     * @deprecated
     * @codeCoverageIgnore
     */
    public static function getGlobalRegionId()
    {
        return self::getDefaultRegionId();
    }

    /**
     * Get the default RegionId.
     *
     * @return null|string
     */
    public static function getDefaultRegionId()
    {
        return self::$defaultRegionId;
    }

    /**
     * Set the default RegionId.
     *
     * @param string $regionId
     *
     * @throws ClientException
     */
    public static function setDefaultRegionId($regionId)
    {
        self::$defaultRegionId = ClientFilter::regionId($regionId);
    }
}
