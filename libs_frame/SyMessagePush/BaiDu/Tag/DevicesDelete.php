<?php
/**
 * 将设备从标签组中移除
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 19:00
 */
namespace SyMessagePush\BaiDu\Tag;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;
use SyTool\Tool;

class DevicesDelete extends PushBaseBaiDu
{
    /**
     * 标签名
     * @var string
     */
    private $tag = '';
    /**
     * 设备ID列表
     * @var array
     */
    private $channel_ids = [];

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/tag/del_devices';
    }

    private function __clone()
    {
    }

    /**
     * @param string $tag
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setTag(string $tag)
    {
        if (ctype_alnum($tag)) {
            $this->reqData['tag'] = $tag;
        } else {
            throw new BaiDuPushException('标签名不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $channelIds
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setChannelIds(array $channelIds)
    {
        $needNum = count($channelIds);
        if ($needNum == 0) {
            throw new BaiDuPushException('设备ID列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        } elseif ($needNum > 10) {
            throw new BaiDuPushException('设备ID列表不能超过10个', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->channel_ids = [];
        foreach ($channelIds as $eChannelId) {
            if (strlen($eChannelId) > 0) {
                $this->channel_ids[$eChannelId] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['tag'])) {
            throw new BaiDuPushException('标签名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (empty($this->channel_ids)) {
            throw new BaiDuPushException('设备ID列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['channel_ids'] = Tool::jsonEncode(array_keys($this->channel_ids), JSON_UNESCAPED_UNICODE);
        return $this->getContent();
    }
}
