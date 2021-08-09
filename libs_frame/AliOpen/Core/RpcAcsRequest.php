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

namespace AliOpen\Core;

use AliOpen\Core\Auth\BearerTokenCredential;

/**
 * Class AliOpen\Core\RpcAcsRequest
 */
abstract class RpcAcsRequest extends AcsRequest
{
    /**
     * @var string
     */
    protected $method = 'GET';
    /**
     * @var string
     */
    protected $acceptFormat = 'JSON';
    /**
     * @var string
     */
    private $dateTimeFormat = 'Y-m-d\TH:i:s\Z';
    /**
     * @var array
     */
    private $domainParameters = [];

    /**
     * @param $iSigner
     * @param $credential
     * @param $domain
     *
     * @return bool|mixed|string
     */
    public function composeUrl($iSigner, $credential, $domain)
    {
        $apiParams = parent::getQueryParameters();
        foreach ($apiParams as $key => $value) {
            $apiParams[$key] = $this->prepareValue($value);
        }
        $apiParams['RegionId'] = $this->getRegionId();
        $apiParams['AccessKeyId'] = $credential->getAccessKeyId();
        $apiParams['Format'] = $this->getAcceptFormat();
        $apiParams['SignatureMethod'] = $iSigner->getSignatureMethod();
        $apiParams['SignatureVersion'] = $iSigner->getSignatureVersion();
        if (null != $iSigner->getSignatureType()) {
            $apiParams['SignatureType'] = $iSigner->getSignatureType();
        }
        $apiParams['SignatureNonce'] = md5(uniqid(mt_rand(), true));
        $apiParams['Timestamp'] = gmdate($this->dateTimeFormat);
        $apiParams['Action'] = $this->getActionName();
        $apiParams['Version'] = $this->getVersion();
        if (null != $credential->getSecurityToken()) {
            $apiParams['SecurityToken'] = $credential->getSecurityToken();
        }
        if ($credential instanceof BearerTokenCredential) {
            $apiParams['BearerToken'] = $credential->getBearerToken();
        }
        $apiParams['Signature'] = $this->computeSignature($apiParams, $credential->getAccessSecret(), $iSigner);
        if ('POST' === parent::getMethod()) {
            $requestUrl = $this->getProtocol() . '://' . $domain . '/';
            foreach ($apiParams as $apiParamKey => $apiParamValue) {
                $this->putDomainParameters($apiParamKey, $apiParamValue);
            }

            return $requestUrl;
        }

        $requestUrl = $this->getProtocol() . '://' . $domain . '/?';

        foreach ($apiParams as $apiParamKey => $apiParamValue) {
            $requestUrl .= "{$apiParamKey}=" . urlencode($apiParamValue) . '&';
        }

        return substr($requestUrl, 0, -1);
    }

    /**
     * @return array
     */
    public function getDomainParameter()
    {
        return $this->domainParameters;
    }

    /**
     * @param $name
     * @param $value
     */
    public function putDomainParameters($name, $value)
    {
        $this->domainParameters[$name] = $value;
    }

    /**
     * @param $str
     *
     * @return null|string|string[]
     */
    protected function percentEncode($str)
    {
        $res = urlencode($str);
        $res = str_replace(['+', '*'], ['%20', '%2A'], $res);

        return preg_replace('/%7E/', '~', $res);
    }

    /**
     * @param bool|string $value
     *
     * @return string
     */
    private function prepareValue($value)
    {
        if (\is_bool($value)) {
            if ($value) {
                return 'true';
            }

            return 'false';
        }

        return $value;
    }

    /**
     * @param $parameters
     * @param $accessKeySecret
     * @param $iSigner
     *
     * @return mixed
     */
    private function computeSignature($parameters, $accessKeySecret, $iSigner)
    {
        ksort($parameters);
        $canonicalizedQueryString = '';
        foreach ($parameters as $key => $value) {
            $canonicalizedQueryString .= '&' . $this->percentEncode($key) . '=' . $this->percentEncode($value);
        }
        $this->stringToBeSigned = parent::getMethod() . '&%2F&'
                                  . $this->percentEncode(substr($canonicalizedQueryString, 1));

        return $iSigner->signString($this->stringToBeSigned, $accessKeySecret . '&');
    }
}
