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
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinOauthException;

/**
 * 获取用户的抖音公开信息，包含昵称、头像、性别和地区；
 *
 * @package SyDouYin\Oauth
 */
class UserInfo extends BaseOauth
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceHostStatus = true;
        $this->serviceUri = '/oauth/userinfo/';
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinOauthException('用户openid不能为空', ErrorCode::DOUYIN_OAUTH_PARAM_ERROR);
        }
        $this->reqData['access_token'] = Util::getAccessToken([
            'client_key' => $this->clientKey,
            'host_type' => $this->serviceHostType,
            'open_id' => $this->reqData['open_id'],
        ]);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
