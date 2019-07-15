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
namespace SyIot\AliYun;

use AliOpen\Core\RpcAcsRequest;

class DeviceGroupRelationsBatchDeleteRequest extends RpcAcsRequest
{
    private $groupId;
    private $Devices;

    public function __construct()
    {
        parent::__construct('Iot', '2018-01-20', 'BatchDeleteDeviceGroupRelations');
        $this->setMethod('POST');
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        $this->queryParameters['GroupId'] = $groupId;
    }

    public function getDevices()
    {
        return $this->Devices;
    }

    public function setDevices($Devices)
    {
        $this->Devices = $Devices;
        for ($i = 0; $i < count($Devices); $i ++) {
            $this->queryParameters['Device.' . ($i + 1) . '.DeviceName'] = $Devices[$i]['DeviceName'];
            $this->queryParameters['Device.' . ($i + 1) . '.ProductKey'] = $Devices[$i]['ProductKey'];
        }
    }
}
