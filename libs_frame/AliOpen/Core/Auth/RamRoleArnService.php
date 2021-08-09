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

use AliOpen\Core\Http\HttpHelper;
use AliOpen\Core\Profile\IClientProfile;

class RamRoleArnService
{
    /**
     * @var string
     */
    public static $serviceDomain = ALIOPEN_STS_DOMAIN;
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
     * AliOpen\Core\Auth\RamRoleArnService constructor.
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
            if ($elapsedTime <= ALIOPEN_ROLE_ARN_EXPIRE_TIME * 0.8) {
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
     * @throws \AliOpen\Core\Exception\ClientException
     */
    private function assumeRole()
    {
        $signer = $this->clientProfile->getSigner();
        $ramRoleArnCredential = $this->clientProfile->getCredential();

        $request =
            new AssumeRoleRequest($ramRoleArnCredential->getRoleArn(), $ramRoleArnCredential->getRoleSessionName());

        $requestUrl = $request->composeUrl($signer, $ramRoleArnCredential, self::$serviceDomain);

        $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), null, $request->getHeaders());

        if (!$httpResponse->isSuccess()) {
            return;
        }

        $respObj = json_decode($httpResponse->getBody());

        $sessionAccessKeyId = $respObj->Credentials->AccessKeyId;
        $sessionAccessKeySecret = $respObj->Credentials->AccessKeySecret;
        $securityToken = $respObj->Credentials->SecurityToken;

        return new Credential($sessionAccessKeyId, $sessionAccessKeySecret, $securityToken);
    }
}
