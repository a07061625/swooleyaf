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

/**
 * 查询指定用户的所有上级父部门路径
 * @package DingDing\Corp\Department
 */
class ParentDepartmentListByUser extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 用户id
     * @var string
     */
    private $userId = '';

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
     * @param string $userId
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserId(string $userId)
    {
        if (ctype_alnum($userId)) {
            $this->reqData['userId'] = $userId;
        } else {
            throw new TalkException('用户id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['userId'])) {
            throw new TalkException('用户id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/department/list_parent_depts?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
