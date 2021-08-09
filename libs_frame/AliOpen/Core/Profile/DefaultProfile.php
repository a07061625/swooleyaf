<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace AliOpen\Core\Profile;

use AliOpen\Core\Auth\AbstractCredential;
use AliOpen\Core\Auth\BearerTokenCredential;
use AliOpen\Core\Auth\BearTokenSigner;
use AliOpen\Core\Auth\Credential;
use AliOpen\Core\Auth\EcsRamRoleCredential;
use AliOpen\Core\Auth\ISigner;
use AliOpen\Core\Auth\RamRoleArnCredential;
use AliOpen\Core\Auth\ShaHmac1Signer;
use AliOpen\Core\Regions\Endpoint;
use AliOpen\Core\Regions\EndpointProvider;
use AliOpen\Core\Regions\LocationService;
use AliOpen\Core\Regions\ProductDomain;
use const ALIOPEN_AUTH_TYPE_BEARER_TOKEN;
use const ALIOPEN_AUTH_TYPE_ECS_RAM_ROLE;
use const ALIOPEN_AUTH_TYPE_RAM_AK;
use const ALIOPEN_AUTH_TYPE_RAM_ROLE_ARN;

/**
 * Class AliOpen\Core\Profile\DefaultProfile
 */
class DefaultProfile implements IClientProfile
{
    /**
     * @var IClientProfile
     */
    private static $profile;
    /**
     * @var array
     */
    private static $endpoints;
    /**
     * @var AbstractCredential
     */
    private static $credential;
    /**
     * @var string
     */
    private static $regionId;
    /**
     * @var string
     */
    private static $acceptFormat;
    /**
     * @var string
     */
    private static $authType;
    /**
     * @var ISigner
     */
    private static $isigner;
    /**
     * @var AbstractCredential
     */
    private static $iCredential;

    /**
     * AliOpen\Core\Profile\DefaultProfile constructor.
     *
     * @param        $regionId
     * @param        $credential
     * @param string $authType
     * @param null   $isigner
     */
    private function __construct($regionId, $credential, $authType = ALIOPEN_AUTH_TYPE_RAM_AK, $isigner = null)
    {
        self::$regionId = $regionId;
        self::$credential = $credential;
        self::$authType = $authType;
        self::$isigner = $isigner;
    }

    /**
     * @param      $regionId
     * @param      $accessKeyId
     * @param      $accessSecret
     * @param null $securityToken
     *
     * @return DefaultProfile|IClientProfile
     */
    public static function getProfile($regionId, $accessKeyId, $accessSecret, $securityToken = null)
    {
        $credential = new Credential($accessKeyId, $accessSecret, $securityToken);
        self::$profile = new self($regionId, $credential);

        return self::$profile;
    }

    /**
     * @param $regionId
     * @param $accessKeyId
     * @param $accessSecret
     * @param $roleArn
     * @param $roleSessionName
     *
     * @return DefaultProfile|IClientProfile
     */
    public static function getRamRoleArnProfile($regionId, $accessKeyId, $accessSecret, $roleArn, $roleSessionName)
    {
        $credential = new RamRoleArnCredential($accessKeyId, $accessSecret, $roleArn, $roleSessionName);
        self::$profile = new self($regionId, $credential, ALIOPEN_AUTH_TYPE_RAM_ROLE_ARN);

        return self::$profile;
    }

    /**
     * @param $regionId
     * @param $roleName
     *
     * @return DefaultProfile|IClientProfile
     */
    public static function getEcsRamRoleProfile($regionId, $roleName)
    {
        $credential = new EcsRamRoleCredential($roleName);
        self::$profile = new self($regionId, $credential, ALIOPEN_AUTH_TYPE_ECS_RAM_ROLE);

        return self::$profile;
    }

    /**
     * @param $regionId
     * @param $bearerToken
     *
     * @return DefaultProfile|IClientProfile
     */
    public static function getBearerTokenProfile($regionId, $bearerToken)
    {
        $credential = new BearerTokenCredential($bearerToken);
        self::$profile = new self($regionId, $credential, ALIOPEN_AUTH_TYPE_BEARER_TOKEN, new BearTokenSigner());

        return self::$profile;
    }

    /**
     * @return null|ISigner|ShaHmac1Signer
     */
    public function getSigner()
    {
        if (null == self::$isigner) {
            self::$isigner = new ShaHmac1Signer();
        }

        return self::$isigner;
    }

    /**
     * @return string
     */
    public function getRegionId()
    {
        return self::$regionId;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return self::$acceptFormat;
    }

    /**
     * @return AbstractCredential
     */
    public function getCredential()
    {
        if (null == self::$credential && null != self::$iCredential) {
            self::$credential = self::$iCredential;
        }

        return self::$credential;
    }

    /**
     * @return bool
     */
    public function isRamRoleArn()
    {
        return ALIOPEN_AUTH_TYPE_RAM_ROLE_ARN == self::$authType;
    }

    /**
     * @return bool
     */
    public function isEcsRamRole()
    {
        return ALIOPEN_AUTH_TYPE_ECS_RAM_ROLE == self::$authType;
    }

    /**
     * @return array
     */
    public static function getEndpoints()
    {
        if (null == self::$endpoints) {
            self::$endpoints = EndpointProvider::getEndpoints();
        }

        return self::$endpoints;
    }

    /**
     * @param $endpointName
     * @param $regionId
     * @param $product
     * @param $domain
     */
    public static function addEndpoint($endpointName, $regionId, $product, $domain)
    {
        if (null == self::$endpoints) {
            self::$endpoints = self::getEndpoints();
        }
        $endpoint = self::findEndpointByName($endpointName);
        if (null == $endpoint) {
            self::addEndpoint_($endpointName, $regionId, $product, $domain);
        } else {
            self::updateEndpoint($regionId, $product, $domain, $endpoint);
        }

        LocationService::addEndPoint($regionId, $product, $domain);
    }

    /**
     * @param $endpointName
     *
     * @return mixed
     */
    public static function findEndpointByName($endpointName)
    {
        if (null === self::$endpoints) {
            return;
        }

        foreach (self::$endpoints as $key => $endpoint) {
            if ($endpoint->getName() == $endpointName) {
                return $endpoint;
            }
        }
    }

    /**
     * @param $endpointName
     * @param $regionId
     * @param $product
     * @param $domain
     */
    private static function addEndpoint_($endpointName, $regionId, $product, $domain)
    {
        $regionIds = [$regionId];
        $productsDomains = [new ProductDomain($product, $domain)];
        $endpoint = new Endpoint($endpointName, $regionIds, $productsDomains);
        self::$endpoints[] = $endpoint;
    }

    /**
     * @param string   $regionId
     * @param string   $product
     * @param string   $domain
     * @param Endpoint $endpoint
     */
    private static function updateEndpoint($regionId, $product, $domain, $endpoint)
    {
        $regionIds = $endpoint->getRegionIds();
        if (!\in_array($regionId, $regionIds)) {
            $regionIds[] = $regionId;
            $endpoint->setRegionIds($regionIds);
        }

        $productDomains = $endpoint->getProductDomains();
        if (null == self::findProductDomainAndUpdate($productDomains, $product, $domain)) {
            $productDomains[] = new ProductDomain($product, $domain);
        }

        $endpoint->setProductDomains($productDomains);
    }

    /**
     * @param $productDomains
     * @param $product
     * @param $domain
     *
     * @return null|string
     */
    private static function findProductDomainAndUpdate($productDomains, $product, $domain)
    {
        foreach ($productDomains as $key => $productDomain) {
            if ($productDomain->getProductName() == $product) {
                $productDomain->setDomainName($domain);

                return $productDomain;
            }
        }
    }
}
