<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-11
 * Time: 下午11:49
 */
namespace Wx\Payment\Way;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class PayMicro extends WxBasePayment
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 商户号
     *
     * @var string
     */
    private $mch_id = '';
    /**
     * 设备号
     *
     * @var string
     */
    private $device_info = '';
    /**
     * 随机字符串
     *
     * @var string
     */
    private $nonce_str = '';
    /**
     * 签名类型
     *
     * @var string
     */
    private $sign_type = '';
    /**
     * 商品描述
     *
     * @var string
     */
    private $body = '';
    /**
     * 商品详情
     *
     * @var string
     */
    private $detail = '';
    /**
     * 附加数据
     *
     * @var string
     */
    private $attach = '';
    /**
     * 商户订单号
     *
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 订单金额
     *
     * @var int
     */
    private $total_fee = 0;
    /**
     * 货币类型
     *
     * @var string
     */
    private $fee_type = '';
    /**
     * 终端IP
     *
     * @var string
     */
    private $spbill_create_ip = '';
    /**
     * 商品标记
     *
     * @var string
     */
    private $goods_tag = '';
    /**
     * 指定支付方式
     *
     * @var string
     */
    private $limit_pay = '';
    /**
     * 交易起始时间
     *
     * @var string
     */
    private $time_start = '';
    /**
     * 交易结束时间
     *
     * @var string
     */
    private $time_expire = '';
    /**
     * 电子发票入口开放标识
     *
     * @var string
     */
    private $receipt = '';
    /**
     * 授权码
     *
     * @var string
     */
    private $auth_code = '';
    /**
     * 场景信息
     *
     * @var string
     */
    private $scene_info = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/pay/micropay';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['spbill_create_ip'] = $accountConfig->getClientIp();
        $this->reqData['sign_type'] = 'MD5';
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['fee_type'] = 'CNY';
        $this->reqData['total_fee'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @param string $body
     *
     * @throws \SyException\Wx\WxException
     */
    public function setBody(string $body)
    {
        if (strlen($body) > 0) {
            $this->reqData['body'] = mb_substr($body, 0, 40);
        } else {
            throw new WxException('商品名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $attach
     *
     * @throws \SyException\Wx\WxException
     */
    public function setAttach(string $attach)
    {
        if (strlen($attach) <= 127) {
            $this->reqData['attach'] = $attach;
        } else {
            throw new WxException('附加数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $outTradeNo
     *
     * @throws \SyException\Wx\WxException
     */
    public function setOutTradeNo(string $outTradeNo)
    {
        if (ctype_digit($outTradeNo) && (strlen($outTradeNo) <= 32)) {
            $this->reqData['out_trade_no'] = $outTradeNo;
        } else {
            throw new WxException('商户单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $totalFee
     *
     * @throws \SyException\Wx\WxException
     */
    public function setTotalFee(int $totalFee)
    {
        if ($totalFee > 0) {
            $this->reqData['total_fee'] = $totalFee;
        } else {
            throw new WxException('支付金额不能小于0', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $authCode
     *
     * @throws \SyException\Wx\WxException
     */
    public function setAuthCode(string $authCode)
    {
        if (ctype_digit($authCode) && (strlen($authCode) == 18) && ($authCode[0] == '1')) {
            $this->reqData['auth_code'] = $authCode;
        } else {
            throw new WxException('授权码不合法', ErrorCode::WX_PARAM_ERROR);
        }
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
     * @param string $detail
     */
    public function setDetail(string $detail)
    {
        if (strlen($detail) > 0) {
            $this->reqData['detail'] = $detail;
        }
    }

    /**
     * @param string $goodsTag
     */
    public function setGoodsTag(string $goodsTag)
    {
        if (strlen($goodsTag) > 0) {
            $this->reqData['goods_tag'] = $goodsTag;
        }
    }

    /**
     * @param string $limitPay
     *
     * @throws \SyException\Wx\WxException
     */
    public function setLimitPay(string $limitPay)
    {
        if ($limitPay === '') {
            unset($this->reqData['limit_pay']);
        } elseif ($limitPay == 'no_credit') {
            $this->reqData['limit_pay'] = $limitPay;
        } else {
            throw new WxException('指定支付方式不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $timeStart
     * @param int $timeExpire
     *
     * @throws \SyException\Wx\WxException
     */
    public function setTime(int $timeStart, int $timeExpire)
    {
        $nowTime = Tool::getNowTime();
        if ($timeStart < 0) {
            throw new WxException('交易起始时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif ($timeExpire < 0) {
            throw new WxException('交易结束时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif (($timeExpire > 0) && ($timeExpire <= $nowTime)) {
            throw new WxException('交易结束时间不能小于当前时间', ErrorCode::WX_PARAM_ERROR);
        } elseif (($timeStart > 0) && ($timeExpire > 0) && ($timeStart >= $timeExpire)) {
            throw new WxException('交易起始时间必须小于交易结束时间', ErrorCode::WX_PARAM_ERROR);
        }

        unset($this->reqData['time_start'], $this->reqData['time_expire']);
        
        if ($timeStart > 0) {
            $this->reqData['time_start'] = date('YmdHis', $timeStart);
        }
        if ($timeExpire > 0) {
            $this->reqData['time_expire'] = date('YmdHis', $timeExpire);
        }
    }

    /**
     * @param string $receipt
     *
     * @throws \SyException\Wx\WxException
     */
    public function setReceipt(string $receipt)
    {
        if ($receipt === '') {
            unset($this->reqData['receipt']);
        } elseif ($receipt == 'Y') {
            $this->reqData['receipt'] = $receipt;
        } else {
            throw new WxException('电子发票入口开放标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $sceneInfo
     */
    public function setSceneInfo(array $sceneInfo)
    {
        if (empty($sceneInfo)) {
            unset($this->reqData['scene_info']);
        } else {
            $this->reqData['scene_info'] = Tool::jsonEncode([
                'store_info' => $sceneInfo
            ], JSON_UNESCAPED_UNICODE);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['body'])) {
            throw new WxException('商品名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['out_trade_no'])) {
            throw new WxException('商户单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($this->reqData['total_fee'] <= 0) {
            throw new WxException('支付金额必须大于0', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['auth_code'])) {
            throw new WxException('授权码不能为空', ErrorCode::WX_PARAM_ERROR);
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
