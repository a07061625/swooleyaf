<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Account;

use DesignPatterns\Singletons\DouYinConfigSingleton;
use SyConstant\ErrorCode;
use SyDouYin\BaseAccount;
use SyDouYin\ServiceHostTrait;
use SyException\DouYin\DouYinAccountException;

/**
 * 获取接口调用的凭证client_access_token，主要用于调用不需要用户授权就可以调用的接口；该接口适用于抖音/头条授权
 *
 * @package SyDouYin\Account
 */
class ClientToken extends BaseAccount
{
    use ServiceHostTrait;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
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
        if (strlen($this->serviceHost) == 0) {
            throw new DouYinAccountException('服务域名不能为空', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
