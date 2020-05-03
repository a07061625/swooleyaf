<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Merchant\Order;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchant;
use Wx\WxUtilBase;
use Wx\WxUtilMerchant;

class OrderList extends WxBaseMerchant
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 订单状态
     * @var int
     */
    private $status = 0;
    /**
     * 创建起始时间
     * @var int
     */
    private $begintime = 0;
    /**
     * 创建终止时间
     * @var int
     */
    private $endtime = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/order/getbyfilter?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param int $status
     * @throws \SyException\Wx\WxException
     */
    public function setStatus(int $status)
    {
        if (in_array($status, [2, 3, 5, 8], true)) {
            $this->reqData['status'] = $status;
        } else {
            throw new WxException('订单状态不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $beginTime
     * @param int $endTime
     * @throws \SyException\Wx\WxException
     */
    public function setCreateTime(int $beginTime, int $endTime)
    {
        if ($beginTime < 0) {
            throw new WxException('创建起始时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif ($endTime < 0) {
            throw new WxException('创建终止时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif (($beginTime > 0) && ($endTime > 0) && ($beginTime > $endTime)) {
            throw new WxException('创建起始时间不能大于终止时间', ErrorCode::WX_PARAM_ERROR);
        }

        if ($beginTime > 0) {
            $this->reqData['begintime'] = $beginTime;
        }
        if ($endTime > 0) {
            $this->reqData['endtime'] = $endTime;
        }
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilMerchant::getAccessToken($this->appid);
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
