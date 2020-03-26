<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:46
 */
namespace Wx\Shop\Pay;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyLog\Log;
use SyTool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class PayCompany extends WxBaseShop
{
    const CHECK_NAME_TYPE_NO = 'NO_CHECK'; //校验姓名类型-不校验
    const CHECK_NAME_TYPE_FORCE = 'FORCE_CHECK'; //校验姓名类型-强制校验

    /**
     * 商户号
     * @var string
     */
    private $mchid = '';
    /**
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';
    /**
     * 商户订单号
     * @var string
     */
    private $partner_trade_no = '';
    /**
     * 用户openid
     * @var string
     */
    private $openid = '';
    /**
     * 校验用户姓名选项
     * @var string
     */
    private $check_name = '';
    /**
     * 收款用户姓名
     * @var string
     */
    private $re_user_name = '';
    /**
     * 金额
     * @var int
     */
    private $amount = 0;
    /**
     * 企业付款描述信息
     * @var string
     */
    private $desc = '';
    /**
     * Ip地址
     * @var string
     */
    private $spbill_create_ip = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['mch_appid'] = $shopConfig->getAppId();
        $this->reqData['mchid'] = $shopConfig->getPayMchId();
        $this->reqData['spbill_create_ip'] = $shopConfig->getClientIp();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['check_name'] = 'NO_CHECK';
        $this->reqData['amount'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @param string $outTradeNo
     * @throws \SyException\Wx\WxException
     */
    public function setOutTradeNo(string $outTradeNo)
    {
        if (ctype_digit($outTradeNo) && (strlen($outTradeNo) <= 32)) {
            $this->reqData['partner_trade_no'] = $outTradeNo;
        } else {
            throw new WxException('商户单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $openid
     * @throws \SyException\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->reqData['openid'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $checkName
     * @throws \SyException\Wx\WxException
     */
    public function setCheckName(string $checkName)
    {
        if ($checkName == self::CHECK_NAME_TYPE_NO) {
            $this->reqData['check_name'] = $checkName;
            unset($this->reqData['re_user_name']);
        } elseif ($checkName == self::CHECK_NAME_TYPE_FORCE) {
            $this->reqData['check_name'] = $checkName;
        } else {
            throw new WxException('校验用户姓名选项不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $userName
     */
    public function setReUserName(string $userName)
    {
        if (($this->reqData['check_name'] == self::CHECK_NAME_TYPE_FORCE) && (strlen($userName) > 0)) {
            $this->reqData['re_user_name'] = mb_substr($userName, 0, 32);
        }
    }

    /**
     * @param int $amount
     * @throws \SyException\Wx\WxException
     */
    public function setAmount(int $amount)
    {
        if ($amount > 0) {
            $this->reqData['amount'] = $amount;
        } else {
            throw new WxException('付款金额必须大于0', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $desc
     * @throws \SyException\Wx\WxException
     */
    public function setDesc(string $desc)
    {
        if (strlen($desc) > 0) {
            $this->reqData['desc'] = $desc;
        } else {
            throw new WxException('付款描述信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['partner_trade_no'])) {
            throw new WxException('商户单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['openid'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (($this->reqData['check_name'] == 'FORCE_CHECK') && !isset($this->reqData['re_user_name'])) {
            throw new WxException('收款用户姓名不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['desc'])) {
            throw new WxException('付款描述信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($this->reqData['amount'] <= 0) {
            throw new WxException('付款金额必须大于0', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->reqData['mch_appid']);

        $resArr = [
            'code' => 0,
        ];

        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($this->reqData['mch_appid']);
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
            Log::error($sendData['return_msg'], ErrorCode::WX_PARAM_ERROR);
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } elseif ($sendData['result_code'] == 'FAIL') {
            Log::error($sendData['err_code'], ErrorCode::WX_PARAM_ERROR);
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
