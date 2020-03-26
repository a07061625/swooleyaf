<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-30
 * Time: 上午11:10
 */
namespace DingDing\Corp\Process;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 批量获取审批实例id
 * @package DingDing\Corp\Process
 */
class InstanceIdList extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 审批码
     * @var string
     */
    private $process_code = '';
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
     * 每页记录数
     * @var int
     */
    private $size = 0;
    /**
     * 分页游标
     * @var int
     */
    private $cursor = 0;
    /**
     * 发起人列表
     * @var string
     */
    private $userid_list = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['size'] = 10;
        $this->reqData['cursor'] = 0;
        $this->reqData['userid_list'] = '';
    }

    private function __clone()
    {
    }

    /**
     * @param string $processCode
     * @throws \SyException\DingDing\TalkException
     */
    public function setProcessCode(string $processCode)
    {
        if (strlen($processCode) > 0) {
            $this->reqData['process_code'] = $processCode;
        } else {
            throw new TalkException('审批码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
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

        $this->reqData['start_time'] = $startTime;
        $this->reqData['end_time'] = $endTime;
    }

    /**
     * @param int $size
     * @throws \SyException\DingDing\TalkException
     */
    public function setSize(int $size)
    {
        if ($size > 0) {
            $this->reqData['size'] = $size > 10 ? 10 : $size;
        } else {
            throw new TalkException('每页记录数不合法', ErrorCode::DING_TALK_PARAM_ERROR);
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
     * @param array $userIdList
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserIdList(array $userIdList)
    {
        $users = [];
        foreach ($userIdList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }
        
        if (count($users) > 10) {
            throw new TalkException('发起人不能超过10个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userid_list'] = implode(',', array_keys($users));
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['process_code'])) {
            throw new TalkException('审批码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_time'])) {
            throw new TalkException('开始时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/processinstance/listids?' . http_build_query([
            'access_token' => $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
