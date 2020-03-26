<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-2
 * Time: 下午1:03
 */
namespace DingDing\Corp\Attendance;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取打卡详情
 * @package DingDing\Corp\Attendance
 */
class RecordList extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 员工列表
     * @var array
     */
    private $userIds = [];
    /**
     * 开始时间
     * @var string
     */
    private $checkDateFrom = '';
    /**
     * 结束时间
     * @var string
     */
    private $checkDateTo = '';
    /**
     * 海外使用标识 true:海外平台使用 false:国内平台使用,默认
     * @var string
     */
    private $isI18n = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['userIds'] = [];
        $this->reqData['isI18n'] = 'false';
    }

    private function __clone()
    {
    }

    /**
     * @param array $userList
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserList(array $userList)
    {
        $users = [];
        foreach ($userList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }

        $userNum = count($users);
        if ($userNum == 0) {
            throw new TalkException('员工列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 50) {
            throw new TalkException('员工不能超过50个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userIds'] = array_keys($users);
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
        } elseif (($endTime - $startTime) > 604800) {
            throw new TalkException('结束时间不能超过开始时间7天', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['checkDateFrom'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['checkDateTo'] = date('Y-m-d H:i:s', $endTime);
    }

    /**
     * @param string $isI18n
     * @throws \SyException\DingDing\TalkException
     */
    public function setIsI18n(string $isI18n)
    {
        if (in_array($isI18n, ['true', 'false'], true)) {
            $this->reqData['isI18n'] = $isI18n;
        } else {
            throw new TalkException('海外使用标识不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (empty($this->reqData['userIds'])) {
            throw new TalkException('员工列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['checkDateFrom'])) {
            throw new TalkException('开始时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/attendance/listRecord?' . http_build_query([
            'access_token' => $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
