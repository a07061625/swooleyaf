<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-7
 * Time: 下午6:37
 */
namespace DingDing\Corp\SmartHrm;

use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyConstant\ErrorCode;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 添加企业待入职员工
 *
 * @package DingDing\Corp\SmartHrm
 */
class EmployeePreEntryAdd extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 姓名
     *
     * @var string
     */
    private $name = '';
    /**
     * 手机号
     *
     * @var string
     */
    private $mobile = '';
    /**
     * 预期入职时间
     *
     * @var int
     */
    private $pre_entry_time = 0;
    /**
     * 操作人用户ID
     *
     * @var string
     */
    private $op_userid = '';
    /**
     * 扩展信息
     *
     * @var string
     */
    private $extend_info = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['param'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @param string $name
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['param']['name'] = $name;
        } else {
            throw new TalkException('姓名不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $mobile
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setMobile(string $mobile)
    {
        if (ctype_digit($mobile) && (strlen($mobile) == 11) && ($mobile[0] == '1')) {
            $this->reqData['param']['mobile'] = $mobile;
        } else {
            throw new TalkException('手机号不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $preEntryTime
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setPreEntryTime(int $preEntryTime)
    {
        if ($preEntryTime > 946656000) {
            $this->reqData['param']['pre_entry_time'] = date('Y-m-d H:i:s', $preEntryTime);
        } else {
            throw new TalkException('预期入职时间不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $opUserId
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setOpUserId(string $opUserId)
    {
        if (ctype_alnum($opUserId)) {
            $this->reqData['param']['op_userid'] = $opUserId;
        } else {
            throw new TalkException('操作人用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param array $extendInfo
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setExtendInfo(array $extendInfo)
    {
        if (empty($extendInfo)) {
            throw new TalkException('扩展信息不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['param']['extend_info'] = Tool::jsonEncode($extendInfo, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['param']['name'])) {
            throw new TalkException('姓名不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['param']['mobile'])) {
            throw new TalkException('手机号不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/smartwork/hrm/employee/addpreentry?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->sendRequest('POST');
    }
}
