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

namespace AliOpen\BaaS;

use AliOpen\Core\RpcAcsRequest;

class CreateOrganizationRequest extends RpcAcsRequest
{
    private $domain;

    private $specName;

    private $name;

    private $description;

    private $location;

    public function __construct()
    {
        parent::__construct('Baas', '2018-07-31', 'CreateOrganization');
        $this->setMethod('POST');
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
        $this->queryParameters['Domain'] = $domain;
    }

    public function getSpecName()
    {
        return $this->specName;
    }

    public function setSpecName($specName)
    {
        $this->specName = $specName;
        $this->queryParameters['SpecName'] = $specName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->queryParameters['Name'] = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->queryParameters['Description'] = $description;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
        $this->queryParameters['Location'] = $location;
    }
}
