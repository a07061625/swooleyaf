<?php
namespace AliOpen\Core\Auth;

use AliOpen\Core\Exception\ClientException;
use AliOpen\Core\Http\HttpHelper;

class RamRoleArnService {
    /**
     * @var \AliOpen\Core\Profile\IClientProfile
     */
    private $clientProfile;
    /**
     * @var null|string
     */
    private $lastClearTime = null;
    /**
     * @var null|string
     */
    private $sessionCredential = null;
    /**
     * @var string
     */
    public static $serviceDomain = ALIOPEN_STS_DOMAIN;

    /**
     * AliOpen\Core\Auth\RamRoleArnService constructor.
     * @param $clientProfile
     */
    public function __construct($clientProfile){
        $this->clientProfile = $clientProfile;
    }

    /**
     * @return \AliOpen\Core\Auth\Credential|string|null
     * @throws ClientException
     */
    public function getSessionCredential(){
        if ($this->lastClearTime != null && $this->sessionCredential != null) {
            $now = time();
            $elapsedTime = $now - $this->lastClearTime;
            if ($elapsedTime <= ALIOPEN_ROLE_ARN_EXPIRE_TIME * 0.8) {
                return $this->sessionCredential;
            }
        }

        $credential = $this->assumeRole();

        if ($credential == null) {
            return null;
        }

        $this->sessionCredential = $credential;
        $this->lastClearTime = time();

        return $credential;
    }

    /**
     * @return \AliOpen\Core\Auth\Credential|null
     * @throws ClientException
     */
    private function assumeRole(){
        $signer = $this->clientProfile->getSigner();
        $ramRoleArnCredential = $this->clientProfile->getCredential();

        $request =
            new \AliOpen\Core\Auth\AssumeRoleRequest($ramRoleArnCredential->getRoleArn(), $ramRoleArnCredential->getRoleSessionName());

        $requestUrl = $request->composeUrl($signer, $ramRoleArnCredential, self::$serviceDomain);

        $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), null, $request->getHeaders());

        if (!$httpResponse->isSuccess()) {
            return null;
        }

        $respObj = json_decode($httpResponse->getBody());

        $sessionAccessKeyId = $respObj->Credentials->AccessKeyId;
        $sessionAccessKeySecret = $respObj->Credentials->AccessKeySecret;
        $securityToken = $respObj->Credentials->SecurityToken;

        return new Credential($sessionAccessKeyId, $sessionAccessKeySecret, $securityToken);
    }
}