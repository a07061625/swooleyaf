<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\User;

use SyConstant\ErrorCode;
use SyDouYin\BaseUser;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinUserException;

/**
 * 根据用户的openid识别其是否关注账号，并返回关注与否结果
 *
 * @package SyDouYin\User
 */
class FansCheck extends BaseUser
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/fans/check/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $followerOpenId 粉丝openid
     *
     * @throws \SyException\DouYin\DouYinUserException
     */
    public function setFollowerOpenId(string $followerOpenId)
    {
        if (\strlen($followerOpenId) > 0) {
            $this->reqData['follower_open_id'] = $followerOpenId;
        } else {
            throw new DouYinUserException('粉丝openid不合法', ErrorCode::DOUYIN_USER_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinUserException('用户openid不能为空', ErrorCode::DOUYIN_USER_PARAM_ERROR);
        }
        if (!isset($this->reqData['follower_open_id'])) {
            throw new DouYinUserException('粉丝openid不能为空', ErrorCode::DOUYIN_USER_PARAM_ERROR);
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
