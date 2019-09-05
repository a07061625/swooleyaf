<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 上午11:15
 */
namespace DingDing\Corp\User;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;

/**
 * 获取部门用户userid列表
 * @package DingDing\Corp\User
 */
class DepartmentMemberGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 部门id
     * @var int
     */
    private $deptId = 0;

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
     * @param int $deptId
     * @throws \SyException\DingDing\TalkException
     */
    public function setDeptId(int $deptId)
    {
        if ($deptId > 0) {
            $this->reqData['deptId'] = $deptId;
        } else {
            throw new TalkException('部门id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['deptId'])) {
            throw new TalkException('部门id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/user/getDeptMember?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
