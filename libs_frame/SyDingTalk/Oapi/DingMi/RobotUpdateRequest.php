<?php

namespace SyDingTalk\Oapi\DingMi;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingmi.robot.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.26
 */
class RobotUpdateRequest extends BaseRequest
{
    /**
     * 服务号(1) | 群(2)
     */
    private $type;
    /**
     * 系统自动生成
     */
    private $updateBotModel;

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setUpdateBotModel($updateBotModel)
    {
        $this->updateBotModel = $updateBotModel;
        $this->apiParas['update_bot_model'] = $updateBotModel;
    }

    public function getUpdateBotModel()
    {
        return $this->updateBotModel;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingmi.robot.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
