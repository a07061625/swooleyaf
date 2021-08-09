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
