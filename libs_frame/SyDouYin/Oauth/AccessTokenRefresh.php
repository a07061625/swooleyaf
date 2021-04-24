<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Oauth;

use SyConstant\ErrorCode;
use SyDouYin\BaseOauth;
use SyException\DouYin\DouYinOauthException;

/**
 * 刷新access_token的有效期；该接口适用于抖音/头条授权
 *
 * @package SyDouYin\Oauth
 */
class AccessTokenRefresh extends BaseOauth
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceHostStatus = true;
        $this->serviceUri = '/oauth/refresh_token/';
        $this->reqData = [
            'client_key' => $this->clientKey,
            'grant_type' => 'refresh_token',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $refreshToken 刷新令牌
     * @throws \SyException\DouYin\DouYinOauthException
     */
    public function setRefreshToken(string $refreshToken)
    {
        if (\strlen($refreshToken) > 0) {
            $this->reqData['refresh_token'] = $refreshToken;
        } else {
            throw new DouYinOauthException('刷新令牌不合法', ErrorCode::DOUYIN_OAUTH_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['refresh_token'])) {
            throw new DouYinOauthException('刷新令牌不能为空', ErrorCode::DOUYIN_OAUTH_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
