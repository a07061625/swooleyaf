<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:46
 */

namespace Wx\Corp\Pay\Payment;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyLog\Log;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxUtilBase;
use Wx\WxUtilCorp;

/**
 * 向员工付款
 *
 * @package Wx\Corp\Pay\Payment
 */
class PocketPay extends WxBaseCorp
{
    const MSG_TYPE_NORMAL = 'NORMAL_MSG'; //付款消息类型-普通付款消息
    const MSG_TYPE_APPROVAL = 'APPROVAL_MSG'; //付款消息类型-审批付款消息
    const CHECK_NAME_TYPE_NO = 'NO_CHECK'; //校验姓名类型-不校验
    const CHECK_NAME_TYPE_FORCE = 'FORCE_CHECK'; //校验姓名类型-强制校验

    /**
     * 企业ID
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
     * 付款说明
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
    /**
     * 付款消息类型
     *
     * @var string
     */
    private $ww_msg_type = '';
    /**
     * 审批单号
     *
     * @var string
     */
    private $approval_number = '';
    /**
     * 审批类型
     *
     * @var int
     */
    private $approval_type = 0;
    /**
     * 项目名称
     *
     * @var string
     */
    private $act_name = '';
    /**
     * 应用id
     *
     * @var string
     */
    private $agentid = '';
    /**
     * 应用密钥
     *
     * @var string
     */
    private $agentSecret = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/paywwsptrans2pocket';
        $corpConfig = WxConfigSingleton::getInstance()->getCorpConfig($corpId);
        $agentInfo = $corpConfig->getAgentInfo($agentTag);
        $this->reqData['appid'] = $corpConfig->getCorpId();
        $this->reqData['mch_id'] = $corpConfig->getPayMchId();
        $this->reqData['spbill_create_ip'] = $corpConfig->getClientIp();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['check_name'] = self::CHECK_NAME_TYPE_NO;
        $this->reqData['ww_msg_type'] = self::MSG_TYPE_NORMAL;
        $this->reqData['amount'] = 0;
        $this->reqData['agentid'] = $agentInfo['id'];
        $this->agentSecret = $agentInfo['secret'];
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDeviceInfo(string $deviceInfo)
    {
        if (ctype_alnum($deviceInfo) && (\strlen($deviceInfo) <= 32)) {
            $this->reqData['device_info'] = $deviceInfo;
        } else {
            throw new WxException('设备号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPartnerTradeNo(string $partnerTradeNo)
    {
        if (ctype_digit($partnerTradeNo) && (\strlen($partnerTradeNo) <= 32)) {
            $this->reqData['partner_trade_no'] = $partnerTradeNo;
        } else {
            throw new WxException('商户订单号不合法', ErrorCode::WX_PARAM_ERROR);
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
            throw new WxException('付款说明不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMsgType(string $msgType)
    {
        if (self::MSG_TYPE_NORMAL == $msgType) {
            $this->reqData['ww_msg_type'] = $msgType;
            unset($this->reqData['approval_number'], $this->reqData['approval_type']);
        } elseif (self::MSG_TYPE_APPROVAL == $msgType) {
            $this->reqData['ww_msg_type'] = $msgType;
            $this->reqData['approval_type'] = 1;
        } else {
            throw new WxException('付款消息类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setApprovalNumber(string $approvalNumber)
    {
        if (self::MSG_TYPE_APPROVAL == $this->reqData['ww_msg_type']) {
            if (ctype_alnum($approvalNumber)) {
                $this->reqData['approval_number'] = $approvalNumber;
            } else {
                throw new WxException('审批单号不合法', ErrorCode::WX_PARAM_ERROR);
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setActName(string $actName)
    {
        if (\strlen($actName) > 0) {
            $this->reqData['act_name'] = mb_substr($actName, 0, 25);
        } else {
            throw new WxException('项目名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['partner_trade_no'])) {
            throw new WxException('商户订单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['openid'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (('FORCE_CHECK' == $this->reqData['check_name']) && !isset($this->reqData['re_user_name'])) {
            throw new WxException('收款用户姓名不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($this->reqData['amount'] <= 0) {
            throw new WxException('付款金额必须大于0', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['desc'])) {
            throw new WxException('付款描述信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ((self::MSG_TYPE_APPROVAL == $this->reqData['ww_msg_type']) && !isset($this->reqData['approval_number'])) {
            throw new WxException('审批单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['act_name'])) {
            throw new WxException('项目名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['workwx_sign'] = WxUtilCorp::createCorpSign($this->reqData, [
            'amount',
            'appid',
            'desc',
            'mch_id',
            'nonce_str',
            'openid',
            'partner_trade_no',
            'ww_msg_type',
        ], $this->agentSecret);

        $corpConfig = WxConfigSingleton::getInstance()->getCorpConfig($this->reqData['appid']);
        $this->reqData['sign'] = WxUtilCorp::createWxSign($this->reqData, $corpConfig->getPayKey());

        $resArr = [
            'code' => 0,
        ];

        $tmpKey = tmpfile();
        fwrite($tmpKey, $corpConfig->getSslKey());
        $tmpKeyData = stream_get_meta_data($tmpKey);
        $tmpCert = tmpfile();
        fwrite($tmpCert, $corpConfig->getSslCert());
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
