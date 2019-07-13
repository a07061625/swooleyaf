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
namespace AliOpen\Nas;

use AliOpen\Core\RpcAcsRequest;

class AccessGroupCreateRequest extends RpcAcsRequest
{
    private $description;
    private $accessGroupType;
    private $accessGroupName;

    public function __construct()
    {
        parent::__construct("NAS", "2017-06-26", "CreateAccessGroup", "nas", "openAPI");
        $this->setMethod("POST");
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->queryParameters["Description"] = $description;
    }

    public function getAccessGroupType()
    {
        return $this->accessGroupType;
    }

    public function setAccessGroupType($accessGroupType)
    {
        $this->accessGroupType = $accessGroupType;
        $this->queryParameters["AccessGroupType"] = $accessGroupType;
    }

    public function getAccessGroupName()
    {
        return $this->accessGroupName;
    }

    public function setAccessGroupName($accessGroupName)
    {
        $this->accessGroupName = $accessGroupName;
        $this->queryParameters["AccessGroupName"] = $accessGroupName;
    }
}
