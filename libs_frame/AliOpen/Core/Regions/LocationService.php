<?php

namespace AliOpen\Core\Regions;

use AliOpen\Core\Http\HttpHelper;

/**
 * Class LocationService
 *
 * @package AliOpen\Core\Regions
 */
class LocationService
{
    /**
     * @var array
     */
    public static $cache = [];
    /**
     * @var array
     */
    public static $lastClearTimePerProduct = [];
    /**
     * @var string
     */
    public static $serviceDomain = ALIOPEN_LOCATION_SERVICE_DOMAIN;
    /**
     * @var \AliOpen\Core\Profile\IClientProfile
     */
    private $clientProfile;

    /**
     * LocationService constructor.
     *
     * @param $clientProfile
     */
    public function __construct($clientProfile)
    {
        $this->clientProfile = $clientProfile;
    }

    /**
     * @param $regionId
     * @param $serviceCode
     * @param $endPointType
     * @param $product
     *
     * @return null|mixed
     *
     * @throws \AliOpen\Core\Exception\ClientException
     */
    public function findProductDomain($regionId, $serviceCode, $endPointType, $product)
    {
        $key = $regionId . '#' . $product;
        $domain = self::$cache[$key] ?? null;
        if (null === $domain || true == $this->checkCacheIsExpire($key)) {
            $domain = $this->findProductDomainFromLocationService($regionId, $serviceCode, $endPointType);
            self::$cache[$key] = $domain;
        }

        return $domain;
    }

    /**
     * @param $regionId
     * @param $product
     * @param $domain
     */
    public static function addEndPoint($regionId, $product, $domain)
    {
        $key = $regionId . '#' . $product;
        self::$cache[$key] = $domain;
        $lastClearTime = mktime(0, 0, 0, 1, 1, 2999);
        self::$lastClearTimePerProduct[$key] = $lastClearTime;
    }

    /**
     * @param $domain
     */
    public static function modifyServiceDomain($domain)
    {
        self::$serviceDomain = $domain;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    private function checkCacheIsExpire($key)
    {
        $lastClearTime = isset(self::$lastClearTimePerProduct[$key]) ? self::$lastClearTimePerProduct[$key] : null;
        if (null === $lastClearTime) {
            $lastClearTime = time();
            self::$lastClearTimePerProduct[$key] = $lastClearTime;
        }

        $now = time();
        $elapsedTime = $now - $lastClearTime;

        if ($elapsedTime > ALIOPEN_CACHE_EXPIRE_TIME) {
            $lastClearTime = time();
            self::$lastClearTimePerProduct[$key] = $lastClearTime;

            return true;
        }

        return false;
    }

    /**
     * @param $regionId
     * @param $serviceCode
     * @param $endPointType
     *
     * @return null|string
     *
     * @throws \AliOpen\Core\Exception\ClientException
     */
    private function findProductDomainFromLocationService($regionId, $serviceCode, $endPointType)
    {
        $request = new DescribeEndpointRequest($regionId, $serviceCode, $endPointType);

        $signer = $this->clientProfile->getSigner();
        $credential = $this->clientProfile->getCredential();

        $requestUrl = $request->composeUrl($signer, $credential, self::$serviceDomain);

        $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), null, $request->getHeaders());

        if (!$httpResponse->isSuccess()) {
            return;
        }

        $respObj = json_decode($httpResponse->getBody());

        return $respObj->Endpoints->Endpoint[0]->Endpoint;
    }
}
