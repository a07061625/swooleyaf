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
use SyDouYin\Util;
use SyException\DouYin\DouYinUserException;

/**
 * 获取用户最近的粉丝列表，不保证顺序；目前可查询的粉丝数上限5千
 *
 * @package SyDouYin\User
 */
class FansList extends BaseUser
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/fans/list/';
        $this->reqData = [
            'cursor' => 0,
            'count' => 10,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $cursor 分页游标
     *
     * @throws \SyException\DouYin\DouYinUserException
     */
    public function setCursor(int $cursor)
    {
        if ($cursor >= 0) {
            $this->reqData['cursor'] = $cursor;
        } else {
            throw new DouYinUserException('分页游标不合法', ErrorCode::DOUYIN_USER_PARAM_ERROR);
        }
    }

    /**
     * @param int $count 每页数量
     *
     * @throws \SyException\DouYin\DouYinUserException
     */
    public function setCount(int $count)
    {
        if ($count > 0) {
            $this->reqData['count'] = $count;
        } else {
            throw new DouYinUserException('每页数量不合法', ErrorCode::DOUYIN_USER_PARAM_ERROR);
        }
    }

    /**
     * @param string $openId 用户openid
     *
     * @throws \SyException\DouYin\DouYinUserException
     */
    public function setOpenId(string $openId)
    {
        if (\strlen($openId) > 0) {
            $this->reqData['open_id'] = $openId;
        } else {
            throw new DouYinUserException('用户openid不合法', ErrorCode::DOUYIN_USER_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinUserException('用户openid不能为空', ErrorCode::DOUYIN_USER_PARAM_ERROR);
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
