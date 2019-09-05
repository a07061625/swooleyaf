<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-11
 * Time: 下午7:56
 */
namespace Wx\Shop\Pay;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class RefundQuery extends WxBaseShop
{
    /**
     * 公众账号ID
     * @var string
     */
    private $appid = '';
    /**
     * 商户号
     * @var string
     */
    private $mch_id = '';
    /**
     * 设备号
     * @var string
     */
    private $device_info = '';
    /**
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';
    /**
     * 签名类型
     * @var string
     */
    private $sign_type = '';
    /**
     * 微信订单号
     * @var string
     */
    private $transaction_id = '';
    /**
     * 商户订单号
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 微信退款单号
     * @var string
     */
    private $refund_id = '';
    /**
     * 商户退款单号
     * @var string
     */
    private $out_refund_no = '';

    public function __construct(string $appId, string $merchantType = self::MERCHANT_TYPE_SELF)
    {
        parent::__construct();

        if (!isset(self::$totalMerchantType[$merchantType])) {
            throw new WxException('商户类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/pay/refundquery';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->merchantType = $merchantType;
        $this->setAppIdAndMchId($shopConfig);
        $this->reqData['sign_type'] = 'MD5';
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
    }

    public function __clone()
    {
    }

    /**
     * @param string $deviceInfo
     */
    public function setDeviceInfo(string $deviceInfo)
    {
        if (strlen($deviceInfo) > 0) {
            $this->reqData['device_info'] = $deviceInfo;
        }
    }

    /**
     * @param string $transactionId
     * @throws \SyException\Wx\WxException
     */
    public function setTransactionId(string $transactionId)
    {
        if (ctype_digit($transactionId) && (strlen($transactionId) == 27)) {
            $this->transaction_id = $transactionId;
        } else {
            throw new WxException('微信订单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $outTradeNo
     * @throws \SyException\Wx\WxException
     */
    public function setOutTradeNo(string $outTradeNo)
    {
        if (ctype_alnum($outTradeNo) && (strlen($outTradeNo) <= 32)) {
            $this->out_trade_no = $outTradeNo;
        } else {
            throw new WxException('商户订单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $refundId
     * @throws \SyException\Wx\WxException
     */
    public function setRefundId(string $refundId)
    {
        if (ctype_digit($refundId) && (strlen($refundId) == 28)) {
            $this->refund_id = $refundId;
        } else {
            throw new WxException('微信退款单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $outRefundNo
     * @throws \SyException\Wx\WxException
     */
    public function setOutRefundNo(string $outRefundNo)
    {
        if (ctype_alnum($outRefundNo) && (strlen($outRefundNo) <= 32)) {
            $this->out_refund_no = $outRefundNo;
        } else {
            throw new WxException('商户退款单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->refund_id) > 0) {
            $this->reqData['refund_id'] = $this->refund_id;
        } elseif (strlen($this->out_refund_no) > 0) {
            $this->reqData['out_refund_no'] = $this->out_refund_no;
        } elseif (strlen($this->transaction_id) > 0) {
            $this->reqData['transaction_id'] = $this->transaction_id;
        } elseif (strlen($this->out_trade_no) > 0) {
            $this->reqData['out_trade_no'] = $this->out_trade_no;
        } else {
            throw new WxException('微信订单号,商户订单号,微信退款单号,商户退款单号必须设置其中一个', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->reqData['appid']);

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::xmlToArray($sendRes);
        if ($sendData['return_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } elseif ($sendData['result_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
