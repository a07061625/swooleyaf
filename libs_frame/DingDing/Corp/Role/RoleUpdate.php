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
 * 更新角色
 * @package DingDing\Corp\Role
 */
class RoleUpdate extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 角色名称
     * @var string
     */
    private $roleName = '';
    /**
     * 角色ID
     * @var int
     */
    private $roleId = 0;

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
     * @param string $roleName
     * @throws \SyException\DingDing\TalkException
     */
    public function setRoleName(string $roleName)
    {
        if (strlen($roleName) > 0) {
            $this->reqData['roleName'] = $roleName;
        } else {
            throw new TalkException('角色名称不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $roleId
     * @throws \SyException\DingDing\TalkException
     */
    public function setRoleId(int $roleId)
    {
        if ($roleId > 0) {
            $this->reqData['roleId'] = $roleId;
        } else {
            throw new TalkException('角色ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['roleName'])) {
            throw new TalkException('角色名称不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['roleId'])) {
            throw new TalkException('角色ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/role/update_role?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
