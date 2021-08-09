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

namespace AliOpen\Core\Auth;

use AliOpen\Core\Exception\ClientException;
use AliOpen\Core\Http\HttpHelper;
use AliOpen\Core\Profile\IClientProfile;

class EcsRamRoleService
{
    /**
     * @var IClientProfile
     */
    private $clientProfile;
    /**
     * @var null|string
     */
    private $lastClearTime;
    /**
     * @var null|string
     */
    private $sessionCredential;

    /**
     * AliOpen\Core\Auth\EcsRamRoleService constructor.
     *
     * @param $clientProfile
     */
    public function __construct($clientProfile)
    {
        $this->clientProfile = $clientProfile;
    }

    /**
     * @return null|Credential|string
     *
     * @throws \AliOpen\Core\Exception\ClientException
     */
    public function getSessionCredential()
    {
        if (null != $this->lastClearTime && null != $this->sessionCredential) {
            $now = time();
            $elapsedTime = $now - $this->lastClearTime;
            if ($elapsedTime <= ALIOPEN_ECS_ROLE_EXPIRE_TIME * 0.8) {
                return $this->sessionCredential;
            }
        }

        $credential = $this->assumeRole();

        if (null == $credential) {
            return;
        }

        $this->sessionCredential = $credential;
        $this->lastClearTime = time();

        return $credential;
    }

    /**
     * @return null|Credential
     *
     * @throws ClientException
     */
    private function assumeRole()
    {
        $ecsRamRoleCredential = $this->clientProfile->getCredential();

        $requestUrl = 'http://100.100.100.200/latest/meta-data/ram/security-credentials/' . $ecsRamRoleCredential->getRoleName();

        $httpResponse = HttpHelper::curl($requestUrl, 'GET', null, null);
        if (!$httpResponse->isSuccess()) {
            return;
        }

        $respObj = json_decode($httpResponse->getBody());

        $code = $respObj->Code;
        if ('Success' != $code) {
            return;
        }

        $sessionAccessKeyId = $respObj->AccessKeyId;
        $sessionAccessKeySecret = $respObj->AccessKeySecret;
        $securityToken = $respObj->SecurityToken;

        return new Credential($sessionAccessKeyId, $sessionAccessKeySecret, $securityToken);
    }
}
