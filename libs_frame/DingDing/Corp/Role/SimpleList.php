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
 * 获取角色下的员工列表
 * @package DingDing\Corp\Role
 */
class SimpleList extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 角色ID
     * @var int
     */
    private $role_id = 0;

    /**
     * 偏移量
     * @var int
     */
    private $offset = 0;
    /**
     * 分页大小
     * @var int
     */
    private $size = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['offset'] = 0;
        $this->reqData['size'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param int $roleId
     * @throws \SyException\DingDing\TalkException
     */
    public function setRoleId(int $roleId)
    {
        if ($roleId > 0) {
            $this->reqData['role_id'] = $roleId;
        } else {
            throw new TalkException('角色ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $offset
     * @throws \SyException\DingDing\TalkException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new TalkException('偏移量不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $size
     * @throws \SyException\DingDing\TalkException
     */
    public function setSize(int $size)
    {
        if ($size > 0) {
            $this->reqData['size'] = $size > 200 ? 200 : $size;
        } else {
            throw new TalkException('分页大小不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['role_id'])) {
            throw new TalkException('角色ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/role/simplelist?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
