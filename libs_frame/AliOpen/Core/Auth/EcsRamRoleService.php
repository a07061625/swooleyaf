<?php
namespace AliOpen\Core\Auth;

use AliOpen\Core\Http\HttpHelper;

class EcsRamRoleService {
    /**
     * @var \AliOpen\Core\Profile\IClientProfile
     */
    private $clientProfile;
    /**
     * @var string|null
     */
    private $lastClearTime = null;
    /**
     * @var string|null
     */
    private $sessionCredential = null;

    /**
     * AliOpen\Core\Auth\EcsRamRoleService constructor.
     * @param $clientProfile
     */
    public function __construct($clientProfile){
        $this->clientProfile = $clientProfile;
    }

    /**
     * @return \AliOpen\Core\Auth\Credential|string|null
     * @throws \AliOpen\Core\Exception\ClientException
     */
    public function getSessionCredential(){
        if ($this->lastClearTime != null && $this->sessionCredential != null) {
            $now = time();
            $elapsedTime = $now - $this->lastClearTime;
            if ($elapsedTime <= ALIOPEN_ECS_ROLE_EXPIRE_TIME * 0.8) {
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
     * @throws \AliOpen\Core\Exception\ClientException
     */
    private function assumeRole(){
        $ecsRamRoleCredential = $this->clientProfile->getCredential();

        $requestUrl = 'http://100.100.100.200/latest/meta-data/ram/security-credentials/' . $ecsRamRoleCredential->getRoleName();

        $httpResponse = HttpHelper::curl($requestUrl, 'GET', null, null);
        if (!$httpResponse->isSuccess()) {
            return null;
        }

        $respObj = json_decode($httpResponse->getBody());

        $code = $respObj->Code;
        if ($code != 'Success') {
            return null;
        }

        $sessionAccessKeyId = $respObj->AccessKeyId;
        $sessionAccessKeySecret = $respObj->AccessKeySecret;
        $securityToken = $respObj->SecurityToken;

        return new Credential($sessionAccessKeyId, $sessionAccessKeySecret, $securityToken);
    }
}