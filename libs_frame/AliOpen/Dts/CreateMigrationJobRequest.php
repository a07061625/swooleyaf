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

namespace AliOpen\Dts;

use AliOpen\Core\RpcAcsRequest;

class CreateMigrationJobRequest extends RpcAcsRequest
{
    protected $clientToken;
    protected $region;
    protected $migrationJobClass;
    protected $ownerId;

    public function __construct()
    {
        parent::__construct('Dts', '2016-08-01', 'CreateMigrationJob');
        $this->setMethod('POST');
    }

    public function getClientToken()
    {
        return $this->clientToken;
    }

    public function setClientToken($clientToken)
    {
        $this->clientToken = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
        $this->queryParameters['Region'] = $region;
    }

    public function getMigrationJobClass()
    {
        return $this->migrationJobClass;
    }

    public function setMigrationJobClass($migrationJobClass)
    {
        $this->migrationJobClass = $migrationJobClass;
        $this->queryParameters['MigrationJobClass'] = $migrationJobClass;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;
    }
}
