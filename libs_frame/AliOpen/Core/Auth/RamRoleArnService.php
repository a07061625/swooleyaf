<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/5 0005
 * Time: 11:16
 */
namespace AliOpen\Core\Auth;

use AliOpen\Core\Http\HttpHelper;
use AliOpen\Sts\RoleAssumeRequest;

/**
 * Class RamRoleArnService
 * @package AliOpen\Core\Auth
 */
class RamRoleArnService
{
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
     * RamRoleArnService constructor.
     * @param $clientProfile
     */
    public function __construct($clientProfile)
    {
        $this->clientProfile = $clientProfile;
    }

    /**
     * @return Credential|string|null
     * @throws \AliOpen\Core\Exception\ClientException
     */
    public function getSessionCredential()
    {
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
     * @return Credential|null
     * @throws \AliOpen\Core\Exception\ClientException
     */
    private function assumeRole()
    {
        $signer = $this->clientProfile->getSigner();
        $ramRoleArnCredential = $this->clientProfile->getCredential();

        $request = new RoleAssumeRequest();
        $request->setRoleArn($ramRoleArnCredential->getRoleArn());
        $request->setRoleSessionName($ramRoleArnCredential->getRoleSessionName());
        $request->setDurationSeconds(ALIOPEN_ROLE_ARN_EXPIRE_TIME);
        $request->setRegionId(ALIOPEN_STS_REGION);
        $request->setProtocol('https');
        $request->setAcceptFormat('JSON');
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
