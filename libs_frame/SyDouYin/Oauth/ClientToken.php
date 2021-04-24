<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Oauth;

use DesignPatterns\Singletons\DouYinConfigSingleton;
use SyDouYin\BaseOauth;

/**
 * 获取接口调用的凭证client_access_token，主要用于调用不需要用户授权就可以调用的接口；该接口适用于抖音/头条授权
 *
 * @package SyDouYin\Oauth
 */
class ClientToken extends BaseOauth
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceHostStatus = true;
        $this->serviceUri = '/oauth/client_token/';
        $config = DouYinConfigSingleton::getInstance()->getAppConfig($clientKey);
        $this->reqData = [
            'client_key' => $config->getClientKey(),
            'client_secret' => $config->getClientSecret(),
            'grant_type' => 'client_credential',
        ];
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
