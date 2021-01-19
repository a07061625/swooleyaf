<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-2
 * Time: 下午2:23
 */

namespace DingDing\Corp\WorkRecord;

use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 发起待办
 *
 * @package DingDing\Corp\WorkRecord
 */
class WorkRecordAdd extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 用户ID
     *
     * @var string
     */
    private $userid = '';
    /**
     * 待办时间
     *
     * @var int
     */
    private $create_time = 0;
    /**
     * 标题
     *
     * @var string
     */
    private $title = '';
    /**
     * 跳转链接
     *
     * @var string
     */
    private $url = '';
    /**
     * 表单列表
     *
     * @var array
     */
    private $formItemList = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['formItemList'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserId(string $userId)
    {
        if (ctype_alnum($userId)) {
            $this->reqData['userid'] = $userId;
        } else {
            throw new TalkException('用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setCreateTime(int $createTime)
    {
        if ($createTime > Tool::getNowTime()) {
            $this->reqData['create_time'] = 1000 * $createTime;
        } else {
            throw new TalkException('待办时间不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setTitle(string $title)
    {
        if (\strlen($title) > 0) {
            $this->reqData['title'] = $title;
        } else {
            throw new TalkException('标题不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setUrl(string $url)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $url) > 0) {
            $this->reqData['url'] = $url;
        } else {
            throw new TalkException('跳转链接不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function addFormItem(array $formItem)
    {
        if (empty($formItem)) {
            throw new TalkException('表单不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['formItemList'][] = $formItem;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['userid'])) {
            throw new TalkException('用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['create_time'])) {
            throw new TalkException('待办时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['title'])) {
            throw new TalkException('标题不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['url'])) {
            throw new TalkException('跳转链接不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (empty($this->reqData['formItemList'])) {
            throw new TalkException('表单列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/workrecord/add?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->sendRequest('POST');
    }
}
