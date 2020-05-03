<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:32
 */
namespace Wx\Payment\Order;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class OrderQuery extends WxBasePayment
{
    /**
     * 商户号
     * @var string
     */
    private $mch_id = '';
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
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';
    /**
     * 签名类型
     * @var string
     */
    private $sign_type = '';

    public function __construct(string $appId, string $merchantType = self::MERCHANT_TYPE_SELF)
    {
        parent::__construct();

        if (!isset(self::$totalMerchantType[$merchantType])) {
            throw new WxException('商户类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/pay/orderquery';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->merchantType = $merchantType;
        $this->setAppIdAndMchId($accountConfig);
        $this->reqData['sign_type'] = 'MD5';
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
    }

    public function __clone()
    {
    }

    /**
     * @param string $transactionId
     * @throws \SyException\Wx\WxException
     */
    public function setTransactionId(string $transactionId)
    {
        if (ctype_digit($transactionId) && (strlen($transactionId) == 28)) {
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

    public function getDetail(): array
    {
        if (strlen($this->transaction_id) > 0) {
            $this->reqData['transaction_id'] = $this->transaction_id;
        } elseif (strlen($this->out_trade_no) > 0) {
            $this->reqData['out_trade_no'] = $this->out_trade_no;
        } else {
            throw new WxException('微信订单号与商户订单号不能同时为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid']);

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
