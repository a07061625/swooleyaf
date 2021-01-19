<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:46
 */

namespace Wx\Payment\Company;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyLog\Log;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class Pay extends WxBasePayment
{
    const CHECK_NAME_TYPE_NO = 'NO_CHECK'; //校验姓名类型-不校验
    const CHECK_NAME_TYPE_FORCE = 'FORCE_CHECK'; //校验姓名类型-强制校验

    /**
     * 商户号
     *
     * @var string
     */
    private $mchid = '';
    /**
     * 随机字符串
     *
     * @var string
     */
    private $nonce_str = '';
    /**
     * 商户订单号
     *
     * @var string
     */
    private $partner_trade_no = '';
    /**
     * 用户openid
     *
     * @var string
     */
    private $openid = '';
    /**
     * 校验用户姓名选项
     *
     * @var string
     */
    private $check_name = '';
    /**
     * 收款用户姓名
     *
     * @var string
     */
    private $re_user_name = '';
    /**
     * 金额
     *
     * @var int
     */
    private $amount = 0;
    /**
     * 企业付款描述信息
     *
     * @var string
     */
    private $desc = '';
    /**
     * Ip地址
     *
     * @var string
     */
    private $spbill_create_ip = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['mch_appid'] = $accountConfig->getAppId();
        $this->reqData['mchid'] = $accountConfig->getPayMchId();
        $this->reqData['spbill_create_ip'] = $accountConfig->getClientIp();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['check_name'] = 'NO_CHECK';
        $this->reqData['amount'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutTradeNo(string $outTradeNo)
    {
        if (ctype_digit($outTradeNo) && (\strlen($outTradeNo) <= 32)) {
            $this->reqData['partner_trade_no'] = $outTradeNo;
        } else {
            throw new WxException('商户单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match(ProjectBase::REGEX_WX_OPEN_ID, $openid) > 0) {
            $this->reqData['openid'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCheckName(string $checkName)
    {
        if (self::CHECK_NAME_TYPE_NO == $checkName) {
            $this->reqData['check_name'] = $checkName;
            unset($this->reqData['re_user_name']);
        } elseif (self::CHECK_NAME_TYPE_FORCE == $checkName) {
            $this->reqData['check_name'] = $checkName;
        } else {
            throw new WxException('校验用户姓名选项不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setReUserName(string $userName)
    {
        if ((self::CHECK_NAME_TYPE_FORCE == $this->reqData['check_name']) && (\strlen($userName) > 0)) {
            $this->reqData['re_user_name'] = mb_substr($userName, 0, 32);
        }
    }

    /**
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
     * @throws \SyException\Wx\WxException
     */
    public function setDesc(string $desc)
    {
        if (\strlen($desc) > 0) {
            $this->reqData['desc'] = $desc;
        } else {
            throw new WxException('付款描述信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['partner_trade_no'])) {
            throw new WxException('商户单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['openid'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (('FORCE_CHECK' == $this->reqData['check_name']) && !isset($this->reqData['re_user_name'])) {
            throw new WxException('收款用户姓名不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['desc'])) {
            throw new WxException('付款描述信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($this->reqData['amount'] <= 0) {
            throw new WxException('付款金额必须大于0', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['mch_appid']);

        $resArr = [
            'code' => 0,
        ];

        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($this->reqData['mch_appid']);
        $tmpKey = tmpfile();
        fwrite($tmpKey, $accountConfig->getSslKey());
        $tmpKeyData = stream_get_meta_data($tmpKey);
        $tmpCert = tmpfile();
        fwrite($tmpCert, $accountConfig->getSslCert());
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
        if ('FAIL' == $sendData['return_code']) {
            Log::error($sendData['return_msg'], ErrorCode::WX_PARAM_ERROR);
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } elseif ('FAIL' == $sendData['result_code']) {
            Log::error($sendData['err_code'], ErrorCode::WX_PARAM_ERROR);
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
