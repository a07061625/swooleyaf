<?php
/**
 * 消息生产基类
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 12:38
 */
namespace SyMessageHandler\Producers;

use SyMessageHandler\HandlerBase;
use SyTool\Tool;

/**
 * Class ProducerBase
 * @package SyMessageHandler\Producers
 */
abstract class Base extends HandlerBase
{
    /**
     * 消息数据
     * @var array
     */
    protected $msgData = [];
    /**
     * 数据校验函数集合
     * @var array
     */
    protected $checkMap = [];

    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
        $this->msgData = [
            'msg_id' => Tool::createNonceStr(8, 'numlower') . Tool::getNowTime(),
            'handler_type' => $handlerType,
            'app_id' => '', //应用ID
            'senders' => [], //发送人
            'receivers' => [], //接收人
            'template_id' => '', //模板ID
            'template_sign' => [], //模板签名
            'template_params' => [], //模板参数
            'send_time' => 0, //发送时间
            'ext_data' => [], //扩展数据
        ];
    }

    protected function checkAppId(array $data) : string
    {
        $appId = $data['app_id'] ?? '';
        if (!is_string($appId)) {
            return '应用ID不合法';
        } elseif (strlen($appId) == 0) {
            return '应用ID不能为空';
        }

        $this->msgData['app_id'] = $appId;
        return '';
    }

    protected function checkTemplateId(array $data) : string
    {
        $templateId = $data['template_id'] ?? '';
        if (!is_string($templateId)) {
            return '模板ID不合法';
        } elseif (strlen($templateId) == 0) {
            return '模板ID不能为空';
        }

        $this->msgData['template_id'] = $templateId;
        return '';
    }

    protected function checkTemplateParams(array $data) : string
    {
        $templateParams = $data['template_params'] ?? [];
        if (!is_array($templateParams)) {
            return '模板参数不合法';
        }

        $this->msgData['template_params'] = $templateParams;
        return '';
    }

    protected function checkSendTime(array $data) : string
    {
        $nowTime = Tool::getNowTime();
        $sendTime = $data['send_time'] ?? $nowTime;
        if (!is_int($sendTime)) {
            return '发送时间不合法';
        } elseif ($sendTime < $nowTime) {
            return '发送时间不合法';
        }

        $this->msgData['send_time'] = $sendTime;
        return '';
    }

    public function checkMsgData(array $msgData) : string
    {
        foreach ($this->checkMap as $funcName) {
            $checkRes = $this->$funcName($msgData);
            if (strlen($checkRes) > 0) {
                return $checkRes;
            }
        }

        return '';
    }

    /**
     * @return array
     */
    public function getMsgData() : array
    {
        return $this->msgData;
    }
}
