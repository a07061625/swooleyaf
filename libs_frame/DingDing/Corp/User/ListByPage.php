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
 * 获取部门用户详情
 * @package DingDing\Corp\User
 */
class ListByPage extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 语言
     * @var string
     */
    private $lang = '';
    /**
     * 部门id
     * @var int
     */
    private $department_id = 0;
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
    /**
     * 排序,可选排序如下
     *   entry_asc: 进入时间升序
     *   entry_desc: 进入时间降序
     *   modify_asc: 修改时间升序
     *   modify_desc: 修改时间降序
     *   custom: 用户定义排序,默认
     * @var string
     */
    private $order = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['lang'] = 'zh_CN';
        $this->reqData['offset'] = 0;
        $this->reqData['size'] = 10;
        $this->reqData['order'] = 'custom';
    }

    private function __clone()
    {
    }

    /**
     * @param string $lang
     * @throws \SyException\DingDing\TalkException
     */
    public function setLang(string $lang)
    {
        if (in_array($lang, ['zh_CN', 'en_US'], true)) {
            $this->reqData['lang'] = $lang;
        } else {
            throw new TalkException('语言不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $departmentId
     * @throws \SyException\DingDing\TalkException
     */
    public function setDepartmentId(int $departmentId)
    {
        if ($departmentId > 0) {
            $this->reqData['department_id'] = $departmentId;
        } else {
            throw new TalkException('部门id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
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
            $this->reqData['size'] = $size > 100 ? 100 : $size;
        } else {
            throw new TalkException('分页大小不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $order
     * @throws \SyException\DingDing\TalkException
     */
    public function setOrder(string $order)
    {
        if (in_array($order, ['entry_asc', 'entry_desc', 'modify_asc', 'modify_desc', 'custom'], true)) {
            $this->reqData['order'] = $order;
        } else {
            throw new TalkException('排序不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['department_id'])) {
            throw new TalkException('部门id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/user/listbypage?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
