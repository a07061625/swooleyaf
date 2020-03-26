<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-5
 * Time: 下午2:35
 */
namespace DingDing\Corp\Department;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 创建部门
 * @package DingDing\Corp\Department
 */
class DepartmentCreate extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 名称
     * @var string
     */
    private $name = '';
    /**
     * 父部门id
     * @var int
     */
    private $parentid = 0;
    /**
     * 排序值
     * @var int
     */
    private $order = 0;
    /**
     * 创建企业群标识
     * @var bool
     */
    private $createDeptGroup = false;
    /**
     * 隐藏部门标识
     * @var bool
     */
    private $deptHiding = false;
    /**
     * 可以查看指定隐藏部门的部门列表
     * @var string
     */
    private $deptPermits = '';
    /**
     * 可以查看指定隐藏部门的人员列表
     * @var string
     */
    private $userPermits = '';
    /**
     * 限制查看通讯录标识
     * @var bool
     */
    private $outerDept = false;
    /**
     * 额外可见部门列表
     * @var string
     */
    private $outerPermitDepts = '';
    /**
     * 额外可见人员列表
     * @var string
     */
    private $outerPermitUsers = '';
    /**
     * 限制查看自己的通讯录标识
     * @var bool
     */
    private $outerDeptOnlySelf = false;
    /**
     * 部门标识
     * @var string
     */
    private $sourceIdentifier = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['order'] = '0';
        $this->reqData['createDeptGroup'] = false;
        $this->reqData['deptHiding'] = false;
        $this->reqData['outerDept'] = false;
        $this->reqData['outerDeptOnlySelf'] = false;
    }

    private function __clone()
    {
    }

    /**
     * @param string $name
     * @throws \SyException\DingDing\TalkException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 32);
        } else {
            throw new TalkException('名称不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $parentId
     * @throws \SyException\DingDing\TalkException
     */
    public function setParentId(int $parentId)
    {
        if ($parentId > 0) {
            $this->reqData['parentid'] = (string)$parentId;
        } else {
            throw new TalkException('父部门id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $order
     * @throws \SyException\DingDing\TalkException
     */
    public function setOrder(int $order)
    {
        if ($order >= 0) {
            $this->reqData['order'] = (string)$order;
        } else {
            throw new TalkException('排序值不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param bool $createDeptGroup
     */
    public function setCreateDeptGroup(bool $createDeptGroup)
    {
        $this->reqData['createDeptGroup'] = $createDeptGroup;
    }

    /**
     * @param bool $deptHiding
     */
    public function setDeptHiding(bool $deptHiding)
    {
        $this->reqData['deptHiding'] = $deptHiding;
    }

    /**
     * @param array $deptPermits
     * @throws \SyException\DingDing\TalkException
     */
    public function setDeptPermits(array $deptPermits)
    {
        $departmentList = [];
        foreach ($deptPermits as $eDepartmentId) {
            if (is_int($eDepartmentId) && ($eDepartmentId > 0)) {
                $departmentList[$eDepartmentId] = 1;
            }
        }

        if (count($departmentList) > 200) {
            throw new TalkException('部门列表不能超过200个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['deptPermits'] = implode('|', array_keys($departmentList));
    }

    /**
     * @param array $userPermits
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserPermits(array $userPermits)
    {
        $userList = [];
        foreach ($userPermits as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $userList[$eUserId] = 1;
            }
        }

        if (count($userList) > 200) {
            throw new TalkException('人员列表不能超过200个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userPermits'] = implode('|', array_keys($userList));
    }

    /**
     * @param bool $outerDept
     */
    public function setOuterDept(bool $outerDept)
    {
        $this->reqData['outerDept'] = $outerDept;
    }

    /**
     * @param array $outerPermitDepts
     * @throws \SyException\DingDing\TalkException
     */
    public function setOuterPermitDepts(array $outerPermitDepts)
    {
        $departmentList = [];
        foreach ($outerPermitDepts as $eDepartmentId) {
            if (is_int($eDepartmentId) && ($eDepartmentId > 0)) {
                $departmentList[$eDepartmentId] = 1;
            }
        }

        if (count($departmentList) > 200) {
            throw new TalkException('额外部门列表不能超过200个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['outerPermitDepts'] = implode('|', array_keys($departmentList));
    }

    /**
     * @param array $outerPermitUsers
     * @throws \SyException\DingDing\TalkException
     */
    public function setOuterPermitUsers(array $outerPermitUsers)
    {
        $userList = [];
        foreach ($outerPermitUsers as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $userList[$eUserId] = 1;
            }
        }

        if (count($userList) > 200) {
            throw new TalkException('额外人员列表不能超过200个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['outerPermitUsers'] = implode('|', array_keys($userList));
    }

    /**
     * @param bool $outerDeptOnlySelf
     */
    public function setOuterDeptOnlySelf(bool $outerDeptOnlySelf)
    {
        $this->reqData['outerDeptOnlySelf'] = $outerDeptOnlySelf;
    }

    /**
     * @param string $sourceIdentifier
     * @throws \SyException\DingDing\TalkException
     */
    public function setSourceIdentifier(string $sourceIdentifier)
    {
        if (ctype_alnum($sourceIdentifier)) {
            $this->reqData['sourceIdentifier'] = $sourceIdentifier;
        } else {
            throw new TalkException('部门标识不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['name'])) {
            throw new TalkException('名称不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['parentid'])) {
            throw new TalkException('父部门id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['sourceIdentifier'])) {
            throw new TalkException('部门标识不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/department/create?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
