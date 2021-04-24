<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Enterprise\Leads;

use SyConstant\ErrorCode;
use SyDouYin\BaseEnterprise;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinEnterpriseException;

/**
 * 获取意向用户互动记录
 *
 * @package SyDouYin\Enterprise\Leads
 */
class UserActionList extends BaseEnterprise
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/enterprise/leads/user/action/list/';
        $this->reqData = [
            'cursor' => 0,
            'count' => 10,
            'action_type' => 0,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $cursor 分页游标
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setCursor(int $cursor)
    {
        if ($cursor >= 0) {
            $this->reqData['cursor'] = $cursor;
        } else {
            throw new DouYinEnterpriseException('分页游标不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param int $count 每页数量
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setCount(int $count)
    {
        if ($count > 0) {
            $this->reqData['count'] = $count;
        } else {
            throw new DouYinEnterpriseException('每页数量不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param string $userId 意向用户openid
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setUserId(string $userId)
    {
        if (\strlen($userId) > 0) {
            $this->reqData['user_id'] = $userId;
        } else {
            throw new DouYinEnterpriseException('意向用户openid不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param int $actionType 动作类型
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setActionType(int $actionType)
    {
        if (\in_array($actionType, [0, 1, 2, 3, 4, 5, 6])) {
            $this->reqData['action_type'] = $actionType;
        } else {
            throw new DouYinEnterpriseException('动作类型不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinEnterpriseException('用户openid不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
        if (!isset($this->reqData['user_id'])) {
            throw new DouYinEnterpriseException('意向用户openid不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }

        $this->reqData['access_token'] = Util::getAccessToken([
            'client_key' => $this->clientKey,
            'host_type' => Util::SERVICE_HOST_TYPE_DOUYIN,
            'open_id' => $this->reqData['open_id'],
        ]);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
