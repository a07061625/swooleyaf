<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/18 0018
 * Time: 11:03
 */
namespace SyIM\Tencent;

use SyConstant\ErrorCode;
use SyException\IM\TencentException;

class UserInformation
{
    /**
     * 用户ID
     * @var string
     */
    private $userId = '';
    /**
     * 用户资料列表
     * @var array
     */
    private $userItems = [];

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getUserId() : string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @throws \SyException\IM\TencentException
     */
    public function setUserId(string $userId)
    {
        if (strlen($userId) <= 32) {
            $this->userId = $userId;
        } else {
            throw new TencentException('用户ID不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return array
     */
    public function getUserItems() : array
    {
        return $this->userItems;
    }

    /**
     * @param array $userItems
     */
    public function setUserItems(array $userItems)
    {
        $this->userItems = $userItems;
    }

    /**
     * @param array $userItem
     */
    public function addUserItem(array $userItem)
    {
        $this->userItems[] = [
            'Tag' => $userItem['tag'],
            'Value' => $userItem['value'],
        ];
    }

    public function getDetail() : array
    {
        if (strlen($this->userId) == 0) {
            throw new TencentException('用户ID不能为空', ErrorCode::IM_PARAM_ERROR);
        }
        if (empty($this->userItems)) {
            throw new TencentException('用户资料不能为空', ErrorCode::IM_PARAM_ERROR);
        }

        return [
            'From_Account' => $this->userId,
            'ProfileItem' => $this->userItems,
        ];
    }
}
