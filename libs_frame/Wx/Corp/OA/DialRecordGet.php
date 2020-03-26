<?php
namespace Wx\Corp\OA;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 获取公费电话拨打记录
 * @package Wx\Corp\OA
 */
class DialRecordGet extends WxBaseCorp
{
    use WxTraitCorp;

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
     * 偏移量
     * @var int
     */
    private $offset = 0;
    /**
     * 每页记录数
     * @var int
     */
    private $limit = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/dial/get_dial_record?access_token=';
        $this->reqData['offset'] = 0;
        $this->reqData['limit'] = 20;
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
        } elseif (($endTime - $startTime) > 2592000) {
            throw new WxException('结束时间不能超过开始时间30天', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['start_time'] = $startTime;
        $this->reqData['end_time'] = $endTime;
    }

    /**
     * @param int $offset
     * @throws \SyException\Wx\WxException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new WxException('偏移量不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\Wx\WxException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 100)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new WxException('每页记录数不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
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
