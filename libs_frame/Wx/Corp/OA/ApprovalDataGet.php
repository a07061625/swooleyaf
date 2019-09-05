<?php
namespace Wx\Corp\OA;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 获取审批数据
 * @package Wx\Corp\OA
 */
class ApprovalDataGet extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 开始时间
     * @var int
     */
    private $starttime = 0;
    /**
     * 结束时间
     * @var int
     */
    private $endtime = 0;
    /**
     * 起始审批单号
     * @var string
     */
    private $next_spnum = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/corp/getapprovaldata?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\Wx\WxException
     */
    public function setStartTimeAndEndTime(int $startTime, int $endTime)
    {
        if ($startTime <= 1000000000) {
            throw new WxException('开始时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif ($endTime <= 1000000000) {
            throw new WxException('结束时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif ($startTime > $endTime) {
            throw new WxException('开始时间不能大于结束时间', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['starttime'] = $startTime;
        $this->reqData['endtime'] = $endTime;
    }

    /**
     * @param string $nextSpnum
     * @throws \SyException\Wx\WxException
     */
    public function setNextSpnum(string $nextSpnum)
    {
        if (ctype_alnum($nextSpnum)) {
            $this->reqData['next_spnum'] = $nextSpnum;
        } else {
            throw new WxException('起始审批单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['starttime'])) {
            throw new WxException('开始时间不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken(WxBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
