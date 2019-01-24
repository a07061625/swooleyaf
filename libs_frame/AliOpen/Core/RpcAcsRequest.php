<?php
namespace AliOpen\Core;

use AliOpen\Core\Auth\BearerTokenCredential;

abstract class RpcAcsRequest extends AcsRequest {
    /**
     * @var string
     */
    private $dateTimeFormat = 'Y-m-d\TH:i:s\Z';
    /**
     * @var array
     */
    private $domainParameters = [];
    /**
     * @var string
     */
    protected $method = 'GET';
    /**
     * @var string
     */
    protected $acceptFormat = 'JSON';

    /**
     * @param string|bool $value
     * @return string
     */
    private function prepareValue($value){
        if (is_bool($value)) {
            if ($value) {
                return 'true';
            }

            return 'false';
        }

        return $value;
    }

    /**
     * @param $iSigner
     * @param $credential
     * @param $domain
     * @return bool|mixed|string
     */
    public function composeUrl($iSigner, $credential, $domain){
        $apiParams = parent::getQueryParameters();
        foreach ($apiParams as $key => $value) {
            $apiParams[$key] = $this->prepareValue($value);
        }
        $apiParams['RegionId'] = $this->getRegionId();
        $apiParams['AccessKeyId'] = $credential->getAccessKeyId();
        $apiParams['Format'] = $this->getAcceptFormat();
        $apiParams['SignatureMethod'] = $iSigner->getSignatureMethod();
        $apiParams['SignatureVersion'] = $iSigner->getSignatureVersion();
        if ($iSigner->getSignatureType() != null) {
            $apiParams['SignatureType'] = $iSigner->getSignatureType();
        }
        $apiParams['SignatureNonce'] = md5(uniqid(mt_rand(), true));
        $apiParams['Timestamp'] = gmdate($this->dateTimeFormat);
        $apiParams['Action'] = $this->getActionName();
        $apiParams['Version'] = $this->getVersion();
        if ($credential->getSecurityToken() != null) {
            $apiParams['SecurityToken'] = $credential->getSecurityToken();
        }
        if ($credential instanceof BearerTokenCredential) {
            $apiParams['BearerToken'] = $credential->getBearerToken();
        }
        $apiParams['Signature'] = $this->computeSignature($apiParams, $credential->getAccessSecret(), $iSigner);
        if (parent::getMethod() === 'POST') {
            $requestUrl = $this->getProtocol() . '://' . $domain . '/';
            foreach ($apiParams as $apiParamKey => $apiParamValue) {
                $this->putDomainParameters($apiParamKey, $apiParamValue);
            }

            return $requestUrl;
        }

        $requestUrl = $this->getProtocol() . '://' . $domain . '/?';

        foreach ($apiParams as $apiParamKey => $apiParamValue) {
            $requestUrl .= "$apiParamKey=" . urlencode($apiParamValue) . '&';
        }

        return substr($requestUrl, 0, - 1);
    }

    /**
     * @param $parameters
     * @param $accessKeySecret
     * @param $iSigner
     * @return mixed
     */
    private function computeSignature($parameters, $accessKeySecret, $iSigner){
        ksort($parameters);
        $canonicalizedQueryString = '';
        foreach ($parameters as $key => $value) {
            $canonicalizedQueryString .= '&' . $this->percentEncode($key) . '=' . $this->percentEncode($value);
        }
        $stringToSign = parent::getMethod() . '&%2F&' . $this->percentEncode(substr($canonicalizedQueryString, 1));

        return $iSigner->signString($stringToSign, $accessKeySecret . '&');
    }

    /**
     * @param $str
     * @return string|string[]|null
     */
    protected function percentEncode($str){
        $res = urlencode($str);
        $res = str_replace(['+', '*'], ['%20', '%2A'], $res);
        $res = preg_replace('/%7E/', '~', $res);

        return $res;
    }

    /**
     * @return array
     */
    public function getDomainParameter(){
        return $this->domainParameters;
    }

    /**
     * @param $name
     * @param $value
     */
    public function putDomainParameters($name, $value){
        $this->domainParameters[$name] = $value;
    }
}
