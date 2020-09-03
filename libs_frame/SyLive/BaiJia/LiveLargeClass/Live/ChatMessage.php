<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 16:01
 */
namespace SyLive\BaiJia\LiveLargeClass\Live;

use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;
use SyTool\Tool;

/**
 * Class ChatMessage
 * @package SyLive\BaiJia\LiveLargeClass\Live
 */
class ChatMessage
{
    /**
     * 消息内容
     * @var string
     */
    private $content = '';
    /**
     * 发送人
     * @var array
     */
    private $from = [];
    /**
     * 用户ID
     * @var int
     */
    private $uid = 0;
    /**
     * 消息时间
     * @var int
     */
    private $time = 0;
    /**
     * 教室ID
     * @var int
     */
    private $class_id = 0;

    public function __construct()
    {
        $this->time = Tool::getNowTime();
    }

    private function __clone()
    {
    }

    /**
     * @param string $content
     * @throws \SyException\Live\BaiJiaException
     */
    public function setContent(string $content)
    {
        $trueContent = trim($content);
        if (strlen($trueContent) > 0) {
            $this->content = $trueContent;
        } else {
            throw new BaiJiaException('消息内容不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param array $from
     * @throws \SyException\Live\BaiJiaException
     */
    public function setFrom(array $from)
    {
        $userId = isset($from['id']) && is_numeric($from['id']) ? (int)$from['id'] : 0;
        if (empty($from)) {
            throw new BaiJiaException('接收人不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($userId <= 0) {
            throw new BaiJiaException('接收人用户ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->from = $from;
        $this->from['id'] = $userId;
        $this->from['status'] = 0;
        $this->from['end_type'] = 0;
        $this->from['group'] = 0;
        $this->from['webrtc_support'] = 1;
        $this->uid = $userId;
    }

    /**
     * @param int $classId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setClassId(int $classId)
    {
        if ($classId > 0) {
            $this->class_id = $classId;
        } else {
            throw new BaiJiaException('教室ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getData() : array
    {
        if (strlen($this->content) == 0) {
            throw new BaiJiaException('消息内容不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($this->uid <= 0) {
            throw new BaiJiaException('用户ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($this->class_id <= 0) {
            throw new BaiJiaException('教室ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        return [
            'message_type' => 'message_send',
            'content' => $this->content,
            'to' => '-1',
            'from' => $this->from,
            'uid' => $this->uid,
            'agent_id' => 0,
            'time' => $this->time,
            'class_id' => $this->class_id,
            'group' => 0,
        ];
    }
}
