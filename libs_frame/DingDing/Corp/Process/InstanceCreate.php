<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-29
 * Time: 下午4:25
 */
namespace DingDing\Corp\Process;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 发起审批实例
 * @package DingDing\Corp\Process
 */
class InstanceCreate extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var int
     */
    private $agent_id = 0;
    /**
     * 审批码
     * @var string
     */
    private $process_code = '';
    /**
     * 发起人用户ID
     * @var string
     */
    private $originator_user_id = '';
    /**
     * 发起人部门ID
     * @var int
     */
    private $dept_id = 0;
    /**
     * 审批人列表
     * @var array
     */
    private $approvers = [];
    /**
     * 抄送人列表
     * @var array
     */
    private $cc_list = [];
    /**
     * 抄送时间
     * @var string
     */
    private $cc_position = '';
    /**
     * 表单参数列表
     * @var array
     */
    private $form_component_values = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['form_component_values'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @param string $processCode
     * @throws \SyException\DingDing\TalkException
     */
    public function setProcessCode(string $processCode)
    {
        if (strlen($processCode) > 0) {
            $this->reqData['process_code'] = $processCode;
        } else {
            throw new TalkException('审批码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $originatorUserId
     * @throws \SyException\DingDing\TalkException
     */
    public function setOriginatorUserId(string $originatorUserId)
    {
        if (ctype_alnum($originatorUserId)) {
            $this->reqData['originator_user_id'] = $originatorUserId;
        } else {
            throw new TalkException('发起人用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $deptId
     * @throws \SyException\DingDing\TalkException
     */
    public function setDeptId(int $deptId)
    {
        if (($deptId == -1) || ($deptId > 0)) {
            $this->reqData['dept_id'] = $deptId;
        } else {
            throw new TalkException('发起人部门ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param array $appRovers
     * @throws \SyException\DingDing\TalkException
     */
    public function setAppRovers(array $appRovers)
    {
        $users = [];
        foreach ($appRovers as $appRoverId) {
            if (ctype_alnum($appRoverId)) {
                $users[$appRoverId] = 1;
            }
        }

        $userNum = count($users);
        if ($userNum == 0) {
            throw new TalkException('审批人列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 20) {
            throw new TalkException('审批人不能超过20个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['approvers'] = implode(',', array_keys($users));
    }

    /**
     * @param array $ccList
     * @throws \SyException\DingDing\TalkException
     */
    public function setCcList(array $ccList)
    {
        $users = [];
        foreach ($ccList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }

        $userNum = count($users);
        if ($userNum == 0) {
            throw new TalkException('抄送人列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 20) {
            throw new TalkException('抄送人不能超过20个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['cc_list'] = implode(',', array_keys($users));
    }

    /**
     * @param string $ccPosition
     * @throws \SyException\DingDing\TalkException
     */
    public function setCcPosition(string $ccPosition)
    {
        if (strlen($ccPosition) > 0) {
            $this->reqData['cc_position'] = $ccPosition;
        } else {
            throw new TalkException('抄送时间不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param array $componentValue
     * @throws \SyException\DingDing\TalkException
     */
    public function addComponentValue(array $componentValue)
    {
        if (empty($componentValue)) {
            throw new TalkException('表单参数不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif (count($this->reqData['form_component_values']) >= 20) {
            throw new TalkException('表单参数不能超过20个', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['form_component_values'][] = $componentValue;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['process_code'])) {
            throw new TalkException('审批码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['originator_user_id'])) {
            throw new TalkException('发起人用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['dept_id'])) {
            throw new TalkException('发起人部门ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['approvers'])) {
            throw new TalkException('审批人列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (empty($this->reqData['form_component_values'])) {
            throw new TalkException('表单参数列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        if ($this->_tokenType == TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP) {
            unset($this->reqData['agent_id']);
        } else {
            $this->reqData['agent_id'] = DingTalkConfigSingleton::getInstance()->getCorpProviderConfig()->getSuiteId();
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/processinstance/create?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
