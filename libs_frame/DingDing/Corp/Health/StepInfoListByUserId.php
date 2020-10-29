<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-31
 * Time: 下午4:20
 */
namespace DingDing\Corp\Health;

use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyConstant\ErrorCode;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 批量获取钉钉运动数据
 *
 * @package DingDing\Corp\Health
 */
class StepInfoListByUserId extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 员工列表
     *
     * @var string
     */
    private $userids = '';
    /**
     * 时间
     *
     * @var string
     */
    private $stat_date = '';

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
     * @param array $userIdList
     *
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

        $userNum = count($users);
        if ($userNum == 0) {
            throw new TalkException('员工列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 50) {
            throw new TalkException('员工总数不能超过50个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userids'] = implode(',', array_keys($users));
    }

    /**
     * @param string $statDate
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setStatDate(string $statDate)
    {
        if (ctype_digit($statDate) && (strlen($statDate) == 8) && ($statDate[0] == '2')) {
            $this->reqData['stat_date'] = $statDate;
        } else {
            throw new TalkException('时间不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['userids'])) {
            throw new TalkException('员工列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['stat_date'])) {
            throw new TalkException('时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/health/stepinfo/listbyuserid?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->sendRequest('POST');
    }
}
