<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-31
 * Time: 下午3:11
 */
namespace DingDing\Corp\Report;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取用户日志数据
 * @package DingDing\Corp\Report
 */
class ReportList extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 开始时间
     * @var int
     */
    private $start_time = 0;
    /**
     * 结束时间
     * @var int
     */
    private $end_time = 0;
    /**
     * 模板名称
     * @var string
     */
    private $template_name = '';
    /**
     * 用户ID
     * @var string
     */
    private $userid = '';
    /**
     * 分页游标
     * @var int
     */
    private $cursor = 0;
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
        $this->reqData['cursor'] = 0;
        $this->reqData['size'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\DingDing\TalkException
     */
    public function setStartTimeAndEndTime(int $startTime, int $endTime)
    {
        if ($startTime < 946656000) {
            throw new TalkException('开始时间不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($endTime < $startTime) {
            throw new TalkException('结束时间不能小于开始时间', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['start_time'] = 1000 * $startTime;
        $this->reqData['end_time'] = 1000 * $endTime;
    }

    /**
     * @param string $templateName
     * @throws \SyException\DingDing\TalkException
     */
    public function setTemplateName(string $templateName)
    {
        if (strlen($templateName) > 0) {
            $this->reqData['template_name'] = $templateName;
        } else {
            throw new TalkException('模板名称不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $userId
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
     * @param int $cursor
     * @throws \SyException\DingDing\TalkException
     */
    public function setCursor(int $cursor)
    {
        if ($cursor >= 0) {
            $this->reqData['cursor'] = $cursor;
        } else {
            throw new TalkException('分页游标不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $size
     * @throws \SyException\DingDing\TalkException
     */
    public function setSize(int $size)
    {
        if ($size > 0) {
            $this->reqData['size'] = $size > 20 ? 20 : $size;
        } else {
            throw new TalkException('分页大小不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['start_time'])) {
            throw new TalkException('开始时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['template_name'])) {
            throw new TalkException('模板名称不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['userid'])) {
            throw new TalkException('用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/report/list?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
