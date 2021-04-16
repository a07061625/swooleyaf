<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Account;

use SyConstant\ErrorCode;
use SyDouYin\BaseAccount;
use SyException\DouYin\DouYinAccountException;

/**
 * 刷新refresh_token的有效期；该接口适用于抖音授权
 *
 * @package SyDouYin\Account
 */
class RefreshTokenRenew extends BaseAccount
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/oauth/renew_refresh_token/';
        $this->reqData = [
            'client_key' => $this->clientKey,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $refreshToken 刷新令牌
     *
     * @throws \SyException\DouYin\DouYinAccountException
     */
    public function setRefreshToken(string $refreshToken)
    {
        if (\strlen($refreshToken) > 0) {
            $this->reqData['refresh_token'] = $refreshToken;
        } else {
            throw new DouYinAccountException('刷新令牌不合法', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['refresh_token'])) {
            throw new DouYinAccountException('刷新令牌不能为空', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
