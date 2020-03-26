<?php
/**
 * User: 姜伟
 * Date: 2018/12/30 0030
 * Time: 11:39
 */
namespace SyMessagePush\XinGe;

use SyConstant\ErrorCode;
use SyException\MessagePush\XinGePushException;
use SyMessagePush\PushBaseXinGe;
use SyTool\Tool;

/**
 * 消息推送
 * @package SyMessagePush\XinGe
 */
class PushApp extends PushBaseXinGe
{
    const MESSAGE_TYPE_NOTIFY = 'notify';
    const MESSAGE_TYPE_SILENT = 'message';

    /**
     * 推送目标
     * @var string
     */
    private $audience_type = '';
    /**
     * 平台类型
     * @var string
     */
    private $platform = '';
    /**
     * 消息体
     * @var array
     */
    private $message = [];
    /**
     * 消息类型
     * @var string
     */
    private $message_type = '';
    /**
     * 消息离线存储时间,单位为秒,最长72小时
     * @var int
     */
    private $expire_time = 0;
    /**
     * 推送时间,格式为yyyy-MM-DD HH:MM:SS,若小于服务器当前时间会立即推送,仅全量推送和标签推送支持此字段
     * @var string
     */
    private $send_time = '';
    /**
     * 多包名推送标识,是否推送多个不同渠道包(应用宝、豌豆荚等)
     * @var bool
     */
    private $multi_pkg = false;
    /**
     * 循环任务重复次数,取值范围1-15,支持全推、标签推
     * @var int
     */
    private $loop_times = 0;
    /**
     * 循环执行消息下发间隔,取值范围1-14,以天为单位
     * @var int
     */
    private $loop_interval = 0;
    /**
     * 推送环境,仅限iOS平台推送使用 product:生产环境 dev:开发环境
     * @var string
     */
    private $environment = '';
    /**
     * 角标数字,仅限iOS平台使用,放在aps字段内 -1:角标数字不变 -2:角标数字自动加1 >=0:设置「自定义」角标数字
     * @var int
     */
    private $badge_type = 0;
    /**
     * 统计标签
     * @var string
     */
    private $stat_tag = '';
    /**
     * 请求ID
     * @var int
     */
    private $seq = 0;
    /**
     * 标签列表
     * @var array
     */
    private $tag_list = [];
    /**
     * 账号列表,要求audience_type=account,最多1000个账号
     * @var array
     */
    private $account_list = [];
    /**
     * 单账号推送类型 0:往单个账号的最新的device上推送信息 1:往单个账号关联的所有device设备上推送信息
     * @var int
     */
    private $account_push_type = 0;
    /**
     * 账号类型
     * @var int
     */
    private $account_type = 0;
    /**
     * 设备列表,要求audience_type=token,最多1000个设备
     * @var array
     */
    private $token_list = [];
    /**
     * 推送ID
     * @var int
     */
    private $push_id = 0;

    public function __construct(string $platform)
    {
        parent::__construct($platform);
        $this->apiPath = 'push';
        $this->apiMethod = 'app';
        $this->reqData['environment'] = 'product';
    }

    private function __clone()
    {
    }

    /**
     * @param string $audienceType
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setAudienceType(string $audienceType)
    {
        if (in_array($audienceType, ['all', 'tag', 'token', 'token_list', 'account', 'account_list'], true)) {
            $this->reqData['audience_type'] = $audienceType;
        } else {
            throw new XinGePushException('推送目标不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $platform
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setPlatform(string $platform)
    {
        if (in_array($platform, [self::PLATFORM_TYPE_ALL, self::PLATFORM_TYPE_IOS, self::PLATFORM_TYPE_ANDROID], true)) {
            $this->reqData['platform'] = $platform;
        } else {
            throw new XinGePushException('平台类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $message
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setMessage(array $message)
    {
        if (empty($message)) {
            throw new XinGePushException('消息体不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['message'] = $message;
    }

    /**
     * @param string $messageType
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setMessageType(string $messageType)
    {
        if (in_array($messageType, [self::MESSAGE_TYPE_NOTIFY, self::MESSAGE_TYPE_SILENT], true)) {
            $this->reqData['message_type'] = $messageType;
        } else {
            throw new XinGePushException('消息类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $expireTime
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setExpireTime(int $expireTime)
    {
        if (($expireTime >= 0) && ($expireTime <= 259200)) {
            $this->reqData['expire_time'] = $expireTime;
        } else {
            throw new XinGePushException('消息离线存储时间不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $sendTime
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setSendTime(int $sendTime)
    {
        if ($sendTime < 0) {
            throw new XinGePushException('发送时间不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $nowSendTime = $sendTime > 0 ? $sendTime : Tool::getNowTime();
        $this->reqData['send_time'] = date('Y-m-d H:i:s', $nowSendTime);
    }

    /**
     * @param bool $multi_pkg
     */
    public function setMultiPkg(bool $multiPkg)
    {
        $this->reqData['multi_pkg'] = $multiPkg;
    }

    /**
     * @param int $loopTimes
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setLoopTimes(int $loopTimes)
    {
        if (($loopTimes > 0) && ($loopTimes <= 15)) {
            $this->reqData['loop_times'] = $loopTimes;
        } else {
            throw new XinGePushException('循环任务重复次数不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $loopInterval
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setLoopInterval(int $loopInterval)
    {
        if (($loopInterval > 0) && ($loopInterval <= 14)) {
            $this->reqData['loop_interval'] = $loopInterval;
        } else {
            throw new XinGePushException('循环任务间隔天数不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $environment
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setEnvironment(string $environment)
    {
        if (in_array($environment, ['dev', 'product'], true)) {
            $this->reqData['environment'] = $environment;
        } else {
            throw new XinGePushException('推送环境不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $badgeType
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setBadgeType(int $badgeType)
    {
        if ($badgeType >= -2) {
            $this->reqData['badge_type'] = $badgeType;
        } else {
            throw new XinGePushException('角标数字不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $statTag
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setStatTag(string $statTag)
    {
        if (strlen($statTag) > 0) {
            $this->reqData['stat_tag'] = $statTag;
        } else {
            throw new XinGePushException('统计标签不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $seq
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setSeq(int $seq)
    {
        if ($seq >= 0) {
            $this->reqData['seq'] = $seq;
        } else {
            throw new XinGePushException('请求ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $tagList
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setTagList(array $tagList)
    {
        if (empty($tagList)) {
            throw new XinGePushException('标签列表不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['tag_list'] = $tagList;
    }

    /**
     * @param array $accountList
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setAccountList(array $accountList)
    {
        $this->account_list = [];
        foreach ($accountList as $eAccount) {
            if (is_string($eAccount) && (strlen($eAccount) > 0)) {
                $this->account_list[$eAccount] = 1;
            }
        }
        if (count($this->account_list) > 1000) {
            throw new XinGePushException('账号列表不能超过1000个', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $accountPushType
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setAccountPushType(int $accountPushType)
    {
        if (in_array($accountPushType, [0, 1], true)) {
            $this->reqData['account_push_type'] = $accountPushType;
        } else {
            throw new XinGePushException('账号推送类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $accountType
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setAccountType(int $accountType)
    {
        if ($accountType >= 0) {
            $this->reqData['account_type'] = $accountType;
        } else {
            throw new XinGePushException('账号类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $tokenList
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setTokenList(array $tokenList)
    {
        $this->token_list = [];
        foreach ($tokenList as $eToken) {
            if (is_string($eToken) && (strlen($eToken) > 0)) {
                $this->token_list[$eToken] = 1;
            }
        }
        if (count($this->token_list) > 1000) {
            throw new XinGePushException('设备列表不能超过1000个', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $pushId
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setPushId(int $pushId)
    {
        if ($pushId >= 0) {
            $this->reqData['push_id'] = $pushId;
        } else {
            throw new XinGePushException('推送ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['audience_type'])) {
            throw new XinGePushException('推送目标不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['platform'])) {
            throw new XinGePushException('平台类型不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['message'])) {
            throw new XinGePushException('消息体不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['message_type'])) {
            throw new XinGePushException('消息类型不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['push_id'])) {
            throw new XinGePushException('推送ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!empty($this->account_list)) {
            $this->reqData['account_list'] = array_keys($this->account_list);
        }
        if (!empty($this->token_list)) {
            $this->reqData['token_list'] = array_keys($this->token_list);
        }

        return $this->getContent();
    }
}
