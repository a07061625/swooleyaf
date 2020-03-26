<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-31
 * Time: 下午3:51
 */
namespace DingDing\Corp\MicroApp;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 设置应用的可见范围
 * @package DingDing\Corp\MicroApp
 */
class VisibleScopesSet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var int
     */
    private $agentId = 0;
    /**
     * 管理员可见标识 true:仅管理员可见 false:非管理员可见
     * @var bool
     */
    private $isHidden = false;
    /**
     * 可见部门列表
     * @var array
     */
    private $deptVisibleScopes = [];
    /**
     * 可见员工列表
     * @var array
     */
    private $userVisibleScopes = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['isHidden'] = false;
        $this->reqData['deptVisibleScopes'] = [];
        $this->reqData['userVisibleScopes'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @param int $agentId
     * @throws \SyException\DingDing\TalkException
     */
    public function setAgentId(int $agentId)
    {
        if ($agentId > 0) {
            $this->reqData['agentId'] = $agentId;
        } else {
            throw new TalkException('应用ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param bool $isHidden
     */
    public function setIsHidden(bool $isHidden)
    {
        $this->reqData['isHidden'] = $isHidden;
    }

    /**
     * @param array $deptVisibleScopes
     */
    public function setDeptVisibleScopes(array $deptVisibleScopes)
    {
        $deptList = [];
        foreach ($deptVisibleScopes as $eDeptId) {
            if (is_int($eDeptId) && ($eDeptId > 0)) {
                $deptList[$eDeptId] = 1;
            }
        }

        $this->reqData['deptVisibleScopes'] = array_keys($deptList);
    }

    /**
     * @param array $userVisibleScopes
     */
    public function setUserVisibleScopes(array $userVisibleScopes)
    {
        $userList = [];
        foreach ($userVisibleScopes as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $userList[$eUserId] = 1;
            }
        }

        $this->reqData['userVisibleScopes'] = array_keys($userList);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['agentId'])) {
            throw new TalkException('应用ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/microapp/set_visible_scopes?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
