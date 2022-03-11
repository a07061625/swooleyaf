<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 8:55
 */

namespace Wx\Payment\Way;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\Alone\JsConfig;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class UnifiedOrder extends WxBasePayment
{
    const TRADE_TYPE_JSAPI = 'JSAPI'; //支付方式-jsapi
    const TRADE_TYPE_NATIVE = 'NATIVE'; //支付方式-扫码
    const TRADE_TYPE_APP = 'APP'; //支付方式-app
    const TRADE_TYPE_MWEB = 'MWEB'; //支付方式-h5

    private static $totalTradeType = [
        self::TRADE_TYPE_JSAPI => 1,
        self::TRADE_TYPE_NATIVE => 1,
        self::TRADE_TYPE_APP => 1,
        self::TRADE_TYPE_MWEB => 1,
    ];

    /**
     * 公众账号ID
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
     * 标价币种
     *
     * @var string
     */
    private $fee_type = '';

    /**
     * 标价金额,单位为分
     *
     * @var int
     */
    private $total_fee = 0;

    /**
     * 终端IP
     *
     * @var string
     */
    private $spbill_create_ip = '';

    /**
     * 交易起始时间,格式为yyyyMMddHHmmss
     *
     * @var string
     */
    private $time_start = '';

    /**
     * 交易结束时间,格式为yyyyMMddHHmmss
     *
     * @var string
     */
    private $time_expire = '';

    /**
     * 商品标记,使用代金券或立减优惠功能时需要的参数
     *
     * @var string
     */
    private $goods_tag = '';

    /**
     * 异步接收微信支付结果通知的回调地址,通知url必须为外网可访问的url,不能携带参数
     *
     * @var string
     */
    private $notify_url = '';

    /**
     * 交易类型,取值如下：JSAPI,NATIVE,APP等
     *
     * @var string
     */
    private $trade_type = '';

    /**
     * 商品ID trade_type=NATIVE时（即扫码支付）,此参数必传
     *
     * @var string
     */
    private $product_id = '';

    /**
     * 用户标识 trade_type=JSAPI时（即公众号支付）,此参数必传
     *
     * @var string
     */
    private $openid = '';

    /**
     * 签名类型 签名类型,默认为MD5,支持HMAC-SHA256和MD5
     *
     * @var string
     */
    private $sign_type = '';

    /**
     * 场景信息,json格式
     *
     * @var string
     */
    private $scene_info = '';

    /**
     * 服务商分账状态,默认不分账 Y:需要分账 N:不分账
     *
     * @var string
     */
    private $profit_sharing = '';

    /**
     * 平台类型
     *
     * @var string
     */
    private $plat_type = '';

    public function __construct(string $appId, string $tradeType, string $merchantType = self::MERCHANT_TYPE_SELF)
    {
        parent::__construct();

        if (!isset(self::$totalTradeType[$tradeType])) {
            throw new WxException('交易类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset(self::$totalMerchantType[$merchantType])) {
            throw new WxException('商户类型不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->serviceUrl = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->merchantType = $merchantType;
        $this->setAppIdAndMchId($accountConfig);
        $this->reqData['notify_url'] = $accountConfig->getPayNotifyUrl();
        $this->reqData['fee_type'] = 'CNY';
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['device_info'] = 'WEB';
        $this->reqData['sign_type'] = 'MD5';
        $this->reqData['total_fee'] = 0;
        $this->reqData['trade_type'] = $tradeType;
        if (self::TRADE_TYPE_MWEB != $tradeType) {
            $this->reqData['spbill_create_ip'] = $accountConfig->getClientIp();
        }
        $this->plat_type = WxUtilBase::PLAT_TYPE_SHOP;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setBody(string $body)
    {
        if (mb_strlen($body) > 0) {
            $this->reqData['body'] = mb_substr($body, 0, 40);
        } else {
            throw new WxException('商品名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAttach(string $attach)
    {
        if (\strlen($attach) <= 127) {
            $this->reqData['attach'] = $attach;
        } else {
            throw new WxException('附加数据过长', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutTradeNo(string $outTradeNo)
    {
        if (ctype_digit($outTradeNo) && (\strlen($outTradeNo) <= 32)) {
            $this->reqData['out_trade_no'] = $outTradeNo;
            if (self::TRADE_TYPE_NATIVE == $this->reqData['trade_type']) {
                $this->reqData['product_id'] = $outTradeNo;
            }
        } else {
            throw new WxException('商户单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
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
     * @throws \SyException\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match(ProjectBase::REGEX_WX_OPEN_ID, $openid) > 0) {
            if (self::MERCHANT_TYPE_SELF == $this->merchantType) {
                $this->reqData['openid'] = $openid;
            } else {
                $this->reqData['sub_openid'] = $openid;
            }
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTerminalIp(string $ip)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $ip) > 0) {
            $this->reqData['spbill_create_ip'] = $ip;
        } else {
            throw new WxException('终端IP不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setSceneInfo(array $sceneInfo)
    {
        if (empty($sceneInfo)) {
            throw new WxException('场景信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['scene_info'] = Tool::jsonEncode($sceneInfo, JSON_UNESCAPED_UNICODE);
    }

    public function setDetail(string $detail)
    {
        if (\strlen($detail) > 0) {
            $this->reqData['detail'] = $detail;
        }
    }

    /**
     * @param string $time_start 格式为yyyyMMddHHmmss
     *
     * @throws \SyException\Wx\WxException
     */
    public function setTimeStart(string $time_start)
    {
        if (ctype_digit($time_start)) {
            $this->reqData['time_start'] = $time_start;
        } else {
            throw new WxException('交易起始时间不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $time_expire 格式为yyyyMMddHHmmss
     *
     * @throws \SyException\Wx\WxException
     */
    public function setTimeExpire(string $time_expire)
    {
        if (ctype_digit($time_expire)) {
            $this->reqData['time_expire'] = $time_expire;
        } else {
            throw new WxException('交易结束时间不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setGoodsTag(string $goods_tag)
    {
        if (\strlen($goods_tag) > 0) {
            $this->reqData['goods_tag'] = $goods_tag;
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPlatType(string $plat_type)
    {
        if (isset(WxUtilBase::$totalPlatTypes[$plat_type])) {
            $this->plat_type = $plat_type;
        } else {
            throw new WxException('平台类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setProfitSharing(string $profit_sharing)
    {
        if (self::MERCHANT_TYPE_SUB != $this->merchantType) {
            throw new WxException('非服务商支付', ErrorCode::WX_PARAM_ERROR);
        }
        if (!\in_array($profit_sharing, ['Y', 'N'])) {
            throw new WxException('服务商分账状态不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['profit_sharing'] = $profit_sharing;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['trade_type'])) {
            throw new WxException('交易类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['body'])) {
            throw new WxException('商品名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['out_trade_no'])) {
            throw new WxException('商户单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($this->reqData['total_fee'] <= 0) {
            throw new WxException('支付金额不能小于0', ErrorCode::WX_PARAM_ERROR);
        }
        if ((self::TRADE_TYPE_NATIVE == $this->reqData['trade_type']) && !isset($this->reqData['product_id'])) {
            throw new WxException('商品ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (self::TRADE_TYPE_MWEB == $this->reqData['trade_type']) {
            if (!isset($this->reqData['spbill_create_ip'])) {
                throw new WxException('终端IP不能为空', ErrorCode::WX_PARAM_ERROR);
            }
            if (!isset($this->reqData['scene_info'])) {
                throw new WxException('场景信息不能为空', ErrorCode::WX_PARAM_ERROR);
            }
        }
        if (self::MERCHANT_TYPE_SELF == $this->merchantType) {
            if ((self::TRADE_TYPE_JSAPI == $this->reqData['trade_type']) && !isset($this->reqData['openid'])) {
                throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
            }
            $appId = $this->reqData['appid'];
            $mchId = $this->reqData['mch_id'];
        } else {
            if ((self::TRADE_TYPE_JSAPI == $this->reqData['trade_type']) && !isset($this->reqData['sub_openid'])) {
                throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
            }
            $appId = $this->reqData['sub_appid'];
            $mchId = $this->reqData['sub_mch_id'];
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid']);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::xmlToArray($sendRes);
        if ('FAIL' == $sendData['return_code']) {
            $resArr['code'] = ErrorCode::WX_PARAM_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } elseif ('FAIL' == $sendData['result_code']) {
            $resArr['code'] = ErrorCode::WX_PARAM_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        } elseif (self::TRADE_TYPE_JSAPI == $this->reqData['trade_type']) {
            $nowTime = Tool::getNowTime();
            //获取支付参数
            $payConfig = new JsPayConfig($appId);
            $payConfig->setTimeStamp((string)$nowTime);
            $payConfig->setPackage($sendData['prepay_id']);
            $resArr['data'] = [
                'pay' => $payConfig->getDetail(),
            ];
            unset($payConfig);

            if (\in_array($this->plat_type, [WxUtilBase::PLAT_TYPE_SHOP, WxUtilBase::PLAT_TYPE_OPEN_SHOP], true)) {
                //获取js参数
                $jsConfig = new JsConfig($appId);
                $jsConfig->setPlatType($this->plat_type);
                $jsConfig->setTimestamp($nowTime);
                $jsConfig->setNonceStr($resArr['data']['pay']['nonceStr']);
                $resArr['data']['config'] = $jsConfig->getDetail();
                unset($jsConfig);
            }
        } elseif (self::TRADE_TYPE_NATIVE == $this->reqData['trade_type']) {
            $resArr['data'] = [
                'code_url' => $sendData['code_url'],
                'prepay_id' => $sendData['prepay_id'],
            ];
        } elseif (self::TRADE_TYPE_APP == $this->reqData['trade_type']) {
            $resArr['data'] = [
                'appid' => $appId,
                'partnerid' => $mchId,
                'prepayid' => $sendData['prepay_id'],
                'timestamp' => (string)Tool::getNowTime(),
                'noncestr' => $sendData['nonce_str'],
                'package' => 'Sign=WXPay',
            ];
            $resArr['data']['sign'] = WxUtilAccount::createSign($resArr['data'], $appId);
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
