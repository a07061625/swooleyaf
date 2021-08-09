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

class CreateLoadBalancerUDPListenerRequest extends RpcAcsRequest
{
    private $access_key_id;
    private $healthCheckConnectTimeout;
    private $resourceOwnerId;
    private $unhealthyThreshold;
    private $healthyThreshold;
    private $aclStatus;
    private $scheduler;
    private $aclType;
    private $maxConnection;
    private $persistenceTimeout;
    private $vpcIds;
    private $vServerGroupId;
    private $aclId;
    private $listenerPort;
    private $resourceOwnerAccount;
    private $bandwidth;
    private $ownerAccount;
    private $ownerId;
    private $tags;
    private $loadBalancerId;
    private $masterSlaveServerGroupId;
    private $healthCheckReq;
    private $backendServerPort;
    private $healthCheckInterval;
    private $healthCheckExp;
    private $healthCheckConnectPort;

    public function __construct()
    {
        parent::__construct('Slb', '2014-05-15', 'CreateLoadBalancerUDPListener', 'slb', 'openAPI');
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

    public function getHealthCheckConnectTimeout()
    {
        return $this->healthCheckConnectTimeout;
    }

    public function setHealthCheckConnectTimeout($healthCheckConnectTimeout)
    {
        $this->healthCheckConnectTimeout = $healthCheckConnectTimeout;
        $this->queryParameters['HealthCheckConnectTimeout'] = $healthCheckConnectTimeout;
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

    public function getUnhealthyThreshold()
    {
        return $this->unhealthyThreshold;
    }

    public function setUnhealthyThreshold($unhealthyThreshold)
    {
        $this->unhealthyThreshold = $unhealthyThreshold;
        $this->queryParameters['UnhealthyThreshold'] = $unhealthyThreshold;
    }

    public function getHealthyThreshold()
    {
        return $this->healthyThreshold;
    }

    public function setHealthyThreshold($healthyThreshold)
    {
        $this->healthyThreshold = $healthyThreshold;
        $this->queryParameters['HealthyThreshold'] = $healthyThreshold;
    }

    public function getAclStatus()
    {
        return $this->aclStatus;
    }

    public function setAclStatus($aclStatus)
    {
        $this->aclStatus = $aclStatus;
        $this->queryParameters['AclStatus'] = $aclStatus;
    }

    public function getScheduler()
    {
        return $this->scheduler;
    }

    public function setScheduler($scheduler)
    {
        $this->scheduler = $scheduler;
        $this->queryParameters['Scheduler'] = $scheduler;
    }

    public function getAclType()
    {
        return $this->aclType;
    }

    public function setAclType($aclType)
    {
        $this->aclType = $aclType;
        $this->queryParameters['AclType'] = $aclType;
    }

    public function getMaxConnection()
    {
        return $this->maxConnection;
    }

    public function setMaxConnection($maxConnection)
    {
        $this->maxConnection = $maxConnection;
        $this->queryParameters['MaxConnection'] = $maxConnection;
    }

    public function getPersistenceTimeout()
    {
        return $this->persistenceTimeout;
    }

    public function setPersistenceTimeout($persistenceTimeout)
    {
        $this->persistenceTimeout = $persistenceTimeout;
        $this->queryParameters['PersistenceTimeout'] = $persistenceTimeout;
    }

    public function getVpcIds()
    {
        return $this->vpcIds;
    }

    public function setVpcIds($vpcIds)
    {
        $this->vpcIds = $vpcIds;
        $this->queryParameters['VpcIds'] = $vpcIds;
    }

    public function getVServerGroupId()
    {
        return $this->vServerGroupId;
    }

    public function setVServerGroupId($vServerGroupId)
    {
        $this->vServerGroupId = $vServerGroupId;
        $this->queryParameters['VServerGroupId'] = $vServerGroupId;
    }

    public function getAclId()
    {
        return $this->aclId;
    }

    public function setAclId($aclId)
    {
        $this->aclId = $aclId;
        $this->queryParameters['AclId'] = $aclId;
    }

    public function getListenerPort()
    {
        return $this->listenerPort;
    }

    public function setListenerPort($listenerPort)
    {
        $this->listenerPort = $listenerPort;
        $this->queryParameters['ListenerPort'] = $listenerPort;
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

    public function getBandwidth()
    {
        return $this->bandwidth;
    }

    public function setBandwidth($bandwidth)
    {
        $this->bandwidth = $bandwidth;
        $this->queryParameters['Bandwidth'] = $bandwidth;
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

    public function getLoadBalancerId()
    {
        return $this->loadBalancerId;
    }

    public function setLoadBalancerId($loadBalancerId)
    {
        $this->loadBalancerId = $loadBalancerId;
        $this->queryParameters['LoadBalancerId'] = $loadBalancerId;
    }

    public function getMasterSlaveServerGroupId()
    {
        return $this->masterSlaveServerGroupId;
    }

    public function setMasterSlaveServerGroupId($masterSlaveServerGroupId)
    {
        $this->masterSlaveServerGroupId = $masterSlaveServerGroupId;
        $this->queryParameters['MasterSlaveServerGroupId'] = $masterSlaveServerGroupId;
    }

    public function gethealthCheckReq()
    {
        return $this->healthCheckReq;
    }

    public function sethealthCheckReq($healthCheckReq)
    {
        $this->healthCheckReq = $healthCheckReq;
        $this->queryParameters['healthCheckReq'] = $healthCheckReq;
    }

    public function getBackendServerPort()
    {
        return $this->backendServerPort;
    }

    public function setBackendServerPort($backendServerPort)
    {
        $this->backendServerPort = $backendServerPort;
        $this->queryParameters['BackendServerPort'] = $backendServerPort;
    }

    public function gethealthCheckInterval()
    {
        return $this->healthCheckInterval;
    }

    public function sethealthCheckInterval($healthCheckInterval)
    {
        $this->healthCheckInterval = $healthCheckInterval;
        $this->queryParameters['healthCheckInterval'] = $healthCheckInterval;
    }

    public function gethealthCheckExp()
    {
        return $this->healthCheckExp;
    }

    public function sethealthCheckExp($healthCheckExp)
    {
        $this->healthCheckExp = $healthCheckExp;
        $this->queryParameters['healthCheckExp'] = $healthCheckExp;
    }

    public function getHealthCheckConnectPort()
    {
        return $this->healthCheckConnectPort;
    }

    public function setHealthCheckConnectPort($healthCheckConnectPort)
    {
        $this->healthCheckConnectPort = $healthCheckConnectPort;
        $this->queryParameters['HealthCheckConnectPort'] = $healthCheckConnectPort;
    }
}
