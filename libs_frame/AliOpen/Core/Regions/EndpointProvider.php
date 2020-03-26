<?php
namespace AliOpen\Core\Regions;

use SyTool\Tool;

class EndpointProvider
{
    /**
     * @var array
     */
    private static $endpoints = [];

    /**
     * @param string $regionId
     * @param string $product
     * @return null
     */
    public static function findProductDomain(string $regionId, string $product)
    {
        $endpoint = Tool::getArrayVal(self::$endpoints, $regionId, null);
        if (is_null($endpoint)) {
            return;
        }

        $productDomains = $endpoint->getProductDomains();
        $productDomain = Tool::getArrayVal($productDomains, $product, null);
        if (is_null($productDomain)) {
            return;
        }

        return $productDomain->getDomainName();
    }

    /**
     * @return array
     */
    public static function getEndpoints()
    {
        return self::$endpoints;
    }

    /**
     * @param array $endpoints
     */
    public static function setEndpoints(array $endpoints)
    {
        self::$endpoints = $endpoints;
    }
}
