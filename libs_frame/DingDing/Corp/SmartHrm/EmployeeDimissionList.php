<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-7
 * Time: 下午6:37
 */
namespace DingDing\Corp\SmartHrm;

use Constant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use Tool\Tool;

/**
 * 获取离职员工离职信息
 * @package DingDing\Corp\SmartHrm
 */
class EmployeeDimissionList extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 员工列表
     * @var string
     */
    private $userid_list = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
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
            throw new TalkException('员工列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 50) {
            throw new TalkException('员工不能超过50个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userid_list'] = implode(',', array_keys($users));
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['userid_list'])) {
            throw new TalkException('员工列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/smartwork/hrm/employee/listdimission?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
