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
 * 获取部门列表
 * @package DingDing\Corp\Department
 */
class DepartmentList extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 语言
     * @var string
     */
    private $lang = '';
    /**
     * 递归部门标识
     * @var bool
     */
    private $fetch_child = false;
    /**
     * 部门id
     * @var int
     */
    private $id = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['lang'] = 'zh_CN';
        $this->reqData['fetch_child'] = false;
    }

    private function __clone()
    {
    }

    /**
     * @param bool $fetchChild
     */
    public function setFetchChild(bool $fetchChild)
    {
        $this->reqData['fetch_child'] = $fetchChild;
    }

    /**
     * @param int $id
     * @throws \SyException\DingDing\TalkException
     */
    public function setId(int $id)
    {
        if ($id > 0) {
            $this->reqData['id'] = $id;
        } else {
            throw new TalkException('部门id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['id'])) {
            throw new TalkException('部门id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/department/list?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
