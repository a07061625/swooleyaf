<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-11
 * Time: 下午10:59
 */
namespace Wx\Shop\Pay;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class OrderRefund extends WxBaseShop {
    /**
     * 公众号ID
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
     * 商户退款单号
     * @var string
     */
    private $out_refund_no = '';
    /**
     * 订单总金额，单位为分
     * @var int
     */
    private $total_fee = 0;
    /**
     * 退款总金额，单位为分
     * @var int
     */
    private $refund_fee = 0;
    /**
     * 货币种类
     * @var string
     */
    private $refund_fee_type = '';
    /**
     * 操作员
     * @var string
     */
    private $op_user_id = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['appid'] = $shopConfig->getAppId();
        $this->reqData['mch_id'] = $shopConfig->getPayMchId();
        $this->reqData['op_user_id'] = $shopConfig->getPayMchId();
        $this->reqData['sign_type'] = 'MD5';
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['refund_fee_type'] = 'CNY';
        $this->reqData['total_fee'] = 0;
        $this->reqData['refund_fee'] = 0;
    }

    public function __clone(){
    }

    /**
     * @param string $deviceInfo
     */
    public function setDeviceInfo(string $deviceInfo) {
        if(strlen($deviceInfo) > 0){
            $this->reqData['device_info'] = $deviceInfo;
        }
    }

    /**
     * @param string $transactionId
     * @throws \Exception\Wx\WxException
     */
    public function setTransactionId(string $transactionId) {
        if(ctype_digit($transactionId) && (strlen($transactionId) == 27)){
            $this->transaction_id = $transactionId;
        } else {
            throw new WxException('微信订单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $outTradeNo
     * @throws \Exception\Wx\WxException
     */
    public function setOutTradeNo(string $outTradeNo) {
        if(ctype_alnum($outTradeNo) && (strlen($outTradeNo) <= 32)){
            $this->out_trade_no = $outTradeNo;
        } else {
            throw new WxException('商户订单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $outRefundNo
     * @throws \Exception\Wx\WxException
     */
    public function setOutRefundNo(string $outRefundNo) {
        if(ctype_alnum($outRefundNo) && (strlen($outRefundNo) <= 32)){
            $this->reqData['out_refund_no'] = $outRefundNo;
        } else {
            throw new WxException('商户退款单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $totalFee
     * @throws \Exception\Wx\WxException
     */
    public function setTotalFee(int $totalFee) {
        if ($totalFee > 0) {
            $this->reqData['total_fee'] = $totalFee;
        } else {
            throw new WxException('订单金额不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $refundFee
     * @throws \Exception\Wx\WxException
     */
    public function setRefundFee(int $refundFee) {
        if ($refundFee > 0) {
            $this->reqData['refund_fee'] = $refundFee;
        } else {
            throw new WxException('退款金额不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(strlen($this->transaction_id) > 0){
            $this->reqData['transaction_id'] = $this->transaction_id;
        } else if(strlen($this->out_trade_no) > 0) {
            $this->reqData['out_trade_no'] = $this->out_trade_no;
        } else {
            throw new WxException('微信订单号和商户订单号必须设置一个', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['out_refund_no'])){
            throw new WxException('商户退款单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if($this->reqData['total_fee'] <= 0){
            throw new WxException('订单金额必须大于0', ErrorCode::WX_PARAM_ERROR);
        } else if($this->reqData['refund_fee'] <= 0){
            throw new WxException('退款金额必须大于0', ErrorCode::WX_PARAM_ERROR);
        } else if($this->reqData['refund_fee'] > $this->reqData['total_fee']){
            throw new WxException('订单金额必须大于等于退款金额', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->reqData['appid']);

        $resArr = [
            'code' => 0
        ];

        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($this->reqData['appid']);
        $tmpKey = tmpfile();
        fwrite($tmpKey, $shopConfig->getSslKey());
        $tmpKeyData = stream_get_meta_data($tmpKey);
        $tmpCert = tmpfile();
        fwrite($tmpCert, $shopConfig->getSslCert());
        $tmpCertData = stream_get_meta_data($tmpCert);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $this->curlConfigs[CURLOPT_SSLCERTTYPE] = 'PEM';
        $this->curlConfigs[CURLOPT_SSLCERT] = $tmpCertData['uri'];
        $this->curlConfigs[CURLOPT_SSLKEYTYPE] = 'PEM';
        $this->curlConfigs[CURLOPT_SSLKEY] = $tmpKeyData['uri'];
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        fclose($tmpKey);
        fclose($tmpCert);
        $sendData = Tool::xmlToArray($sendRes);
        if ($sendData['return_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } else if ($sendData['result_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        }
        $resArr['data'] = $sendData;

        return $resArr;
    }
}