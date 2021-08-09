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

namespace AliOpen\Uis;

use AliOpen\Core\RpcAcsRequest;

class AddUisNodeIpRequest extends RpcAcsRequest
{
    private $resourceOwnerId;
    private $uisNodeId;
    private $resourceOwnerAccount;
    private $clientToken;
    private $ownerAccount;
    private $ipAddrsNum;
    private $ownerId;

    public function __construct()
    {
        parent::__construct('Uis', '2018-08-21', 'AddUisNodeIp', 'uis', 'openAPI');
        $this->setMethod('POST');
    }

    public function getResourceOwnerId()
    {
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;
    }

    public function getUisNodeId()
    {
        return $this->uisNodeId;
    }

    public function setUisNodeId($uisNodeId)
    {
        $this->uisNodeId = $uisNodeId;
        $this->queryParameters['UisNodeId'] = $uisNodeId;
    }

    public function getResourceOwnerAccount()
    {
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
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

    public function getOwnerAccount()
    {
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount)
    {
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;
    }

    public function getIpAddrsNum()
    {
        return $this->ipAddrsNum;
    }

    public function setIpAddrsNum($ipAddrsNum)
    {
        $this->ipAddrsNum = $ipAddrsNum;
        $this->queryParameters['IpAddrsNum'] = $ipAddrsNum;
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
