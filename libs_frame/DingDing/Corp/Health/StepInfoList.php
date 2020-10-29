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
 * 获取个人或部门的钉钉运动数据
 *
 * @package DingDing\Corp\Health
 */
class StepInfoList extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 数据类型 0:取用户步数 1:取部门步数
     *
     * @var int
     */
    private $type = 0;
    /**
     * 用户或部门ID
     *
     * @var string
     */
    private $object_id = '';
    /**
     * 时间列表
     *
     * @var string
     */
    private $stat_dates = '';

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
     * @param int    $type
     * @param string $objectId
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setTypeAndObjectId(int $type, string $objectId)
    {
        if (!in_array($type, [0, 1], true)) {
            throw new TalkException('数据类型不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif (($type == 0) && !ctype_alnum($objectId)) {
            throw new TalkException('用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif (($type == 1) && !ctype_digit($objectId)) {
            throw new TalkException('部门ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        
        $this->reqData['type'] = $type;
        $this->reqData['object_id'] = $objectId;
    }

    /**
     * @param array $statDates
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setStatDates(array $statDates)
    {
        $dateList = [];
        foreach ($statDates as $eDate) {
            if (ctype_digit($eDate) && (strlen($eDate) == 8) && ($eDate[0] == '2')) {
                $dateList[$eDate] = 1;
            }
        }

        $dateNum = count($dateList);
        if ($dateNum == 0) {
            throw new TalkException('时间列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($dateNum > 31) {
            throw new TalkException('时间总数不能超过31天', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['stat_dates'] = implode(',', array_keys($dateList));
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['type'])) {
            throw new TalkException('数据类型不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['stat_dates'])) {
            throw new TalkException('时间列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/health/stepinfo/list?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->sendRequest('POST');
    }
}
