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

namespace AliOpen\Jaq;

use AliOpen\Core\RpcAcsRequest;

class ActivityPreventionRequest extends RpcAcsRequest
{
    private $callerName;
    private $ip;
    private $protocolVersion;
    private $source;
    private $activityDescription;
    private $activityId;
    private $prize;
    private $prizeType;
    private $phoneNumber;
    private $email;
    private $userId;
    private $idType;
    private $currentUrl;
    private $agent;
    private $cookie;
    private $sessionId;
    private $macAddress;
    private $referer;
    private $userName;
    private $companyName;
    private $address;
    private $iDNumber;
    private $bankCardNumber;
    private $registerIp;
    private $registerDate;
    private $extendData;
    private $jsToken;
    private $sDKToken;

    public function __construct()
    {
        parent::__construct('jaq', '2016-11-23', 'ActivityPrevention');
    }

    public function getCallerName()
    {
        return $this->callerName;
    }

    public function setCallerName($callerName)
    {
        $this->callerName = $callerName;
        $this->queryParameters['CallerName'] = $callerName;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
        $this->queryParameters['Ip'] = $ip;
    }

    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    public function setProtocolVersion($protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;
        $this->queryParameters['ProtocolVersion'] = $protocolVersion;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function setSource($source)
    {
        $this->source = $source;
        $this->queryParameters['Source'] = $source;
    }

    public function getActivityDescription()
    {
        return $this->activityDescription;
    }

    public function setActivityDescription($activityDescription)
    {
        $this->activityDescription = $activityDescription;
        $this->queryParameters['ActivityDescription'] = $activityDescription;
    }

    public function getActivityId()
    {
        return $this->activityId;
    }

    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;
        $this->queryParameters['ActivityId'] = $activityId;
    }

    public function getPrize()
    {
        return $this->prize;
    }

    public function setPrize($prize)
    {
        $this->prize = $prize;
        $this->queryParameters['Prize'] = $prize;
    }

    public function getPrizeType()
    {
        return $this->prizeType;
    }

    public function setPrizeType($prizeType)
    {
        $this->prizeType = $prizeType;
        $this->queryParameters['PrizeType'] = $prizeType;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        $this->queryParameters['PhoneNumber'] = $phoneNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->queryParameters['Email'] = $email;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->queryParameters['UserId'] = $userId;
    }

    public function getIdType()
    {
        return $this->idType;
    }

    public function setIdType($idType)
    {
        $this->idType = $idType;
        $this->queryParameters['IdType'] = $idType;
    }

    public function getCurrentUrl()
    {
        return $this->currentUrl;
    }

    public function setCurrentUrl($currentUrl)
    {
        $this->currentUrl = $currentUrl;
        $this->queryParameters['CurrentUrl'] = $currentUrl;
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function setAgent($agent)
    {
        $this->agent = $agent;
        $this->queryParameters['Agent'] = $agent;
    }

    public function getCookie()
    {
        return $this->cookie;
    }

    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
        $this->queryParameters['Cookie'] = $cookie;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
        $this->queryParameters['SessionId'] = $sessionId;
    }

    public function getMacAddress()
    {
        return $this->macAddress;
    }

    public function setMacAddress($macAddress)
    {
        $this->macAddress = $macAddress;
        $this->queryParameters['MacAddress'] = $macAddress;
    }

    public function getReferer()
    {
        return $this->referer;
    }

    public function setReferer($referer)
    {
        $this->referer = $referer;
        $this->queryParameters['Referer'] = $referer;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
        $this->queryParameters['UserName'] = $userName;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        $this->queryParameters['CompanyName'] = $companyName;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        $this->queryParameters['Address'] = $address;
    }

    public function getIDNumber()
    {
        return $this->iDNumber;
    }

    public function setIDNumber($iDNumber)
    {
        $this->iDNumber = $iDNumber;
        $this->queryParameters['IDNumber'] = $iDNumber;
    }

    public function getBankCardNumber()
    {
        return $this->bankCardNumber;
    }

    public function setBankCardNumber($bankCardNumber)
    {
        $this->bankCardNumber = $bankCardNumber;
        $this->queryParameters['BankCardNumber'] = $bankCardNumber;
    }

    public function getRegisterIp()
    {
        return $this->registerIp;
    }

    public function setRegisterIp($registerIp)
    {
        $this->registerIp = $registerIp;
        $this->queryParameters['RegisterIp'] = $registerIp;
    }

    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;
        $this->queryParameters['RegisterDate'] = $registerDate;
    }

    public function getExtendData()
    {
        return $this->extendData;
    }

    public function setExtendData($extendData)
    {
        $this->extendData = $extendData;
        $this->queryParameters['ExtendData'] = $extendData;
    }

    public function getJsToken()
    {
        return $this->jsToken;
    }

    public function setJsToken($jsToken)
    {
        $this->jsToken = $jsToken;
        $this->queryParameters['JsToken'] = $jsToken;
    }

    public function getSDKToken()
    {
        return $this->sDKToken;
    }

    public function setSDKToken($sDKToken)
    {
        $this->sDKToken = $sDKToken;
        $this->queryParameters['SDKToken'] = $sDKToken;
    }
}
