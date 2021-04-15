<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 15:50
 */

namespace SyDouYin\Account;

use DesignPatterns\Singletons\DouYinConfigSingleton;
use SyConstant\ErrorCode;
use SyDouYin\BaseAccount;
use SyDouYin\ServiceHostTrait;
use SyException\DouYin\DouYinAccountException;

/**
 * 获取用户授权第三方接口调用的凭证access_token；该接口适用于抖音/头条授权
 *
 * @package SyDouYin\Account
 */
class AccessToken extends BaseAccount
{
    use ServiceHostTrait;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $config = DouYinConfigSingleton::getInstance()->getAppConfig($clientKey);
        $this->reqData = [
            'client_key' => $config->getClientKey(),
            'client_secret' => $config->getClientSecret(),
            'grant_type' => 'authorization_code',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $code 授权码
     *
     * @throws \SyException\DouYin\DouYinAccountException
     */
    public function setCode(string $code)
    {
        if (\strlen($code) > 0) {
            $this->reqData['code'] = $code;
        } else {
            throw new DouYinAccountException('授权码不合法', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['code'])) {
            throw new DouYinAccountException('授权码不能为空', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
