<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-3
 * Time: 下午12:51
 */
namespace DingDing\Corp\Message;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 查询工作通知消息的发送进度
 * @package DingDing\Corp\Message
 */
class CorpSendProgressGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var int
     */
    private $agent_id = 0;
    /**
     * 任务ID
     * @var int
     */
    private $task_id = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['agent_id'] = $agentInfo['id'];
    }

    private function __clone()
    {
    }

    /**
     * @param int $taskId
     * @throws \SyException\DingDing\TalkException
     */
    public function setTaskId(int $taskId)
    {
        if ($taskId > 0) {
            $this->reqData['task_id'] = $taskId;
        } else {
            throw new TalkException('任务ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['task_id'])) {
            throw new TalkException('任务ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/message/corpconversation/getsendprogress?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
