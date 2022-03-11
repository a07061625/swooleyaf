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

class OrderSetDelivery extends WxBaseMerchant
{
    const DELIVERY_STATUS_NO = 0; //物流状态-不需要
    const DELIVERY_STATUS_YES = 1; //物流状态-需要

    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 订单ID
     *
     * @var string
     */
    private $order_id = '';
    /**
     * 物流公司
     *
     * @var string
     */
    private $delivery_company = '';
    /**
     * 运单ID
     *
     * @var string
     */
    private $delivery_track_no = '';
    /**
     * 物流状态(0-不需要 1-需要)
     *
     * @var int
     */
    private $need_delivery = 0;
    /**
     * 其它物流公司状态(0-否 1-是)
     *
     * @var int
     */
    private $is_others = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/order/setdelivery?access_token=';
        $this->appid = $appId;
        $this->reqData['need_delivery'] = self::DELIVERY_STATUS_YES;
        $this->reqData['is_others'] = 0;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOrderId(string $orderId)
    {
        if (ctype_digit($orderId) && (\strlen($orderId) <= 32)) {
            $this->reqData['order_id'] = $orderId;
        } else {
            throw new WxException('订单ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDeliveryCompany(string $deliveryCompany)
    {
        if (\strlen($deliveryCompany) > 0) {
            $this->reqData['delivery_company'] = $deliveryCompany;
        } else {
            throw new WxException('物流公司不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDeliveryTrackNo(string $deliveryTrackNo)
    {
        if (\strlen($deliveryTrackNo) > 0) {
            $this->reqData['delivery_track_no'] = $deliveryTrackNo;
        } else {
            throw new WxException('运单ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setNeedDelivery(int $needDelivery)
    {
        if (\in_array($needDelivery, [self::DELIVERY_STATUS_NO, self::DELIVERY_STATUS_YES], true)) {
            $this->reqData['need_delivery'] = $needDelivery;
        } else {
            throw new WxException('物流状态不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setIsOthers(int $isOthers)
    {
        if (\in_array($isOthers, [0, 1], true)) {
            $this->reqData['is_others'] = $isOthers;
        } else {
            throw new WxException('其它物流公司状态不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['order_id'])) {
            throw new WxException('订单ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (self::DELIVERY_STATUS_YES == $this->reqData['need_delivery']) {
            if (!isset($this->reqData['delivery_company'])) {
                throw new WxException('物流公司不能为空', ErrorCode::WX_PARAM_ERROR);
            }
            if (!isset($this->reqData['delivery_track_no'])) {
                throw new WxException('运单ID不能为空', ErrorCode::WX_PARAM_ERROR);
            }
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilMerchant::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
