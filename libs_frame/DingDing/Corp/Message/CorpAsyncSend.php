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
 * 发送工作通知消息
 * @package DingDing\Corp\Message
 */
class CorpAsyncSend extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var int
     */
    private $agent_id = 0;
    /**
     * 用户列表
     * @var string
     */
    private $userid_list = '';
    /**
     * 部门列表
     * @var string
     */
    private $dept_id_list = '';
    /**
     * 发送全部用户标识
     * @var bool
     */
    private $to_all_user = false;
    /**
     * 消息内容
     * @var string
     */
    private $msg = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['to_all_user'] = false;
        $this->reqData['agent_id'] = $agentInfo['id'];
    }

    private function __clone()
    {
    }

    /**
     * @param array $userList
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserList(array $userList)
    {
        $users = [];
        foreach ($userList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }

        $userNum = count($users);
        if ($userNum == 0) {
            throw new TalkException('用户列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 20) {
            throw new TalkException('用户不能超过20个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userid_list'] = implode(',', array_keys($users));
    }

    /**
     * @param array $departList
     * @throws \SyException\DingDing\TalkException
     */
    public function setDepartmentList(array $departList)
    {
        $departs = [];
        foreach ($departList as $eDepartId) {
            if (is_int($eDepartId) && ($eDepartId > 0)) {
                $departs[$eDepartId] = 1;
            }
        }

        $departNum = count($departs);
        if ($departNum == 0) {
            throw new TalkException('部门列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($departNum > 20) {
            throw new TalkException('部门不能超过20个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['dept_id_list'] = implode(',', array_keys($departs));
    }

    /**
     * @param bool $toAllUser
     */
    public function setToAllUser(bool $toAllUser)
    {
        $this->reqData['to_all_user'] = $toAllUser;
    }

    /**
     * @param string $type
     * @param array $data
     * @throws \SyException\DingDing\TalkException
     */
    public function setMsgData(string $type, array $data)
    {
        if (!isset(self::$totalMessageType[$type])) {
            throw new TalkException('消息类型不支持', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif (empty($data)) {
            throw new TalkException('消息数据不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['msg'] = [
            'msgtype' => $type,
            $type => $data,
        ];
    }

    public function getDetail() : array
    {
        if ((!isset($this->reqData['userid_list'])) && !isset($this->reqData['dept_id_list'])) {
            throw new TalkException('用户列表和部门列表不能同时为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['msg'])) {
            throw new TalkException('消息内容不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/message/corpconversation/asyncsend_v2?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
