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

namespace AliOpen\Slb;

use AliOpen\Core\RpcAcsRequest;

class UploadServerCertificateRequest extends RpcAcsRequest
{
    private $access_key_id;
    private $resourceOwnerId;
    private $serverCertificate;
    private $resourceOwnerAccount;
    private $ownerAccount;
    private $aliCloudCertificateName;
    private $aliCloudCertificateId;
    private $ownerId;
    private $tags;
    private $privateKey;
    private $resourceGroupId;
    private $serverCertificateName;

    public function __construct()
    {
        parent::__construct('Slb', '2014-05-15', 'UploadServerCertificate', 'slb', 'openAPI');
        $this->setMethod('POST');
    }

    public function getaccess_key_id()
    {
        return $this->access_key_id;
    }

    public function setaccess_key_id($access_key_id)
    {
        $this->access_key_id = $access_key_id;
        $this->queryParameters['access_key_id'] = $access_key_id;
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

    public function getServerCertificate()
    {
        return $this->serverCertificate;
    }

    public function setServerCertificate($serverCertificate)
    {
        $this->serverCertificate = $serverCertificate;
        $this->queryParameters['ServerCertificate'] = $serverCertificate;
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

    public function getOwnerAccount()
    {
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount)
    {
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;
    }

    public function getAliCloudCertificateName()
    {
        return $this->aliCloudCertificateName;
    }

    public function setAliCloudCertificateName($aliCloudCertificateName)
    {
        $this->aliCloudCertificateName = $aliCloudCertificateName;
        $this->queryParameters['AliCloudCertificateName'] = $aliCloudCertificateName;
    }

    public function getAliCloudCertificateId()
    {
        return $this->aliCloudCertificateId;
    }

    public function setAliCloudCertificateId($aliCloudCertificateId)
    {
        $this->aliCloudCertificateId = $aliCloudCertificateId;
        $this->queryParameters['AliCloudCertificateId'] = $aliCloudCertificateId;
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

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
        $this->queryParameters['Tags'] = $tags;
    }

    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
        $this->queryParameters['PrivateKey'] = $privateKey;
    }

    public function getResourceGroupId()
    {
        return $this->resourceGroupId;
    }

    public function setResourceGroupId($resourceGroupId)
    {
        $this->resourceGroupId = $resourceGroupId;
        $this->queryParameters['ResourceGroupId'] = $resourceGroupId;
    }

    public function getServerCertificateName()
    {
        return $this->serverCertificateName;
    }

    public function setServerCertificateName($serverCertificateName)
    {
        $this->serverCertificateName = $serverCertificateName;
        $this->queryParameters['ServerCertificateName'] = $serverCertificateName;
    }
}
