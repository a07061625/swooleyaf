<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-6
 * Time: 下午4:17
 */
namespace DingDing\Corp\Role;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 批量删除员工角色
 * @package DingDing\Corp\Role
 */
class UserRoleDeleteBatch extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 角色列表
     * @var string
     */
    private $roleIds = '';
    /**
     * 用户列表
     * @var string
     */
    private $userIds = '';

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
     * @param array $roleList
     * @throws \SyException\DingDing\TalkException
     */
    public function setRoleList(array $roleList)
    {
        $roles = [];
        foreach ($roleList as $eRoleId) {
            if (is_int($eRoleId) && ($eRoleId > 0)) {
                $roles[$eRoleId] = 1;
            }
        }

        $roleNum = count($roles);
        if ($roleNum == 0) {
            throw new TalkException('角色列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($roleNum > 20) {
            throw new TalkException('角色不能超过20个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['roleIds'] = implode(',', array_keys($roles));
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
        } elseif ($userNum > 100) {
            throw new TalkException('用户不能超过100个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userIds'] = implode(',', array_keys($users));
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['roleIds'])) {
            throw new TalkException('角色列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['userIds'])) {
            throw new TalkException('用户列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/role/removerolesforemps?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
