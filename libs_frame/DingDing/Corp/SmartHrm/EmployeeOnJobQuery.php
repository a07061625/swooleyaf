<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-7
 * Time: 下午6:37
 */
namespace DingDing\Corp\SmartHrm;

use Constant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use Tool\Tool;

/**
 * 查询企业在职员工列表
 * @package DingDing\Corp\SmartHrm
 */
class EmployeeOnJobQuery extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 状态列表
     * @var string
     */
    private $status_list = '';
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
     * @param array $statusList
     * @throws \SyException\DingDing\TalkException
     */
    public function setStatusList(array $statusList)
    {
        $statusArr = [];
        foreach ($statusList as $eStatus) {
            if (is_int($eStatus)) {
                $statusArr[$eStatus] = 1;
            }
        }

        if (count($statusArr) == 0) {
            throw new TalkException('状态列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['status_list'] = implode(',', array_keys($statusArr));
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
            $this->reqData['size'] = $size > 20 ? 20 : $size;
        } else {
            throw new TalkException('分页大小不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['status_list'])) {
            throw new TalkException('状态列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/smartwork/hrm/employee/queryonjob?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
