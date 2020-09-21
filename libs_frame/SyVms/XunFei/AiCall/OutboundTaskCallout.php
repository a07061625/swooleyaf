<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/21 0021
 * Time: 15:33
 */
namespace SyVms\XunFei\AiCall;

use SyConstant\ErrorCode;
use SyException\Vms\XunFeiException;
use SyVms\BaseXunFeiAiCall;
use SyVms\UtilXunFei;

/**
 * 直接外呼
 *
 * @package SyVms\XunFei\AiCall
 */
class OutboundTaskCallout extends BaseXunFeiAiCall
{
    /**
     * 话术编号
     *
     * @var string
     */
    private $robot_id = '';
    /**
     * 线路号码
     *
     * @var string
     */
    private $line_num = '';
    /**
     * 外呼数据列
     *
     * @var array
     */
    private $call_column = [];
    /**
     * 外呼数据行
     *
     * @var array
     */
    private $call_list = [];
    /**
     * 发音人编码
     *
     * @var string
     */
    private $voice_code = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://callapi.xfyun.cn/v1/service/v1/aicall/outbound/v1/task/callout?token=';
        $this->reqData = [];
    }

    private function __clone()
    {
    }

    /**
     * @param string $robotId
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setRobotId(string $robotId)
    {
        if (strlen($robotId) > 0) {
            $this->reqData['robot_id'] = $robotId;
        } else {
            throw new XunFeiException('话术编号不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $lineNum
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setLineNum(string $lineNum)
    {
        if (ctype_digit($lineNum)) {
            $this->reqData['line_num'] = $lineNum;
        } else {
            throw new XunFeiException('线路号码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param array $callColumn
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setCallColumn(array $callColumn)
    {
        $columns = [];
        foreach ($callColumn as $eColumn) {
            if (is_string($eColumn) && (strlen($eColumn) > 0)) {
                $columns[] = $eColumn;
            }
        }
        if (empty($columns)) {
            throw new XunFeiException('外呼数据列不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        $this->reqData['call_column'] = $columns;
    }

    /**
     * @param array $callList
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setCallList(array $callList)
    {
        $num = count($callList);
        if ($num == 0) {
            throw new XunFeiException('外呼数据行不能为空', ErrorCode::VMS_PARAM_ERROR);
        } elseif ($num > 50) {
            throw new XunFeiException('外呼数据行不能超过50条', ErrorCode::VMS_PARAM_ERROR);
        }
        $this->reqData['call_list'] = $callList;
    }

    /**
     * @param string $voiceCode
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setVoiceCode(string $voiceCode)
    {
        if (ctype_digit($voiceCode)) {
            $this->reqData['voice_code'] = $voiceCode;
        } else {
            throw new XunFeiException('发音人编码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['robot_id'])) {
            throw new XunFeiException('话术编号不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['line_num'])) {
            throw new XunFeiException('线路号码不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['call_column'])) {
            throw new XunFeiException('外呼数据列不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['call_list'])) {
            throw new XunFeiException('外呼数据行不能为空', ErrorCode::VMS_PARAM_ERROR);
        }

        $this->getContent();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . UtilXunFei::getAiCallToken();

        return $this->curlConfigs;
    }
}
