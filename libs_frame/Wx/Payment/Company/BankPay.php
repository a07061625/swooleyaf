<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/12 0012
 * Time: 17:08
 */
namespace Wx\Payment\Company;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;
use Wx\WxUtilPayment;

class BankPay extends WxBasePayment
{
    const BANK_CODE_CMB = '1001';
    const BANK_CODE_ICBC = '1002';
    const BANK_CODE_CCB = '1003';
    const BANK_CODE_SPDB = '1004';
    const BANK_CODE_ABC = '1005';
    const BANK_CODE_CMBC = '1006';
    const BANK_CODE_CIB = '1009';
    const BANK_CODE_PAB = '1010';
    const BANK_CODE_BCM = '1020';
    const BANK_CODE_ZXB = '1021';
    const BANK_CODE_CEB = '1022';
    const BANK_CODE_HXB = '1025';
    const BANK_CODE_BOC = '1026';
    const BANK_CODE_GDB = '1027';
    const BANK_CODE_BOB = '1032';
    const BANK_CODE_NBB = '1056';
    const BANK_CODE_PSBC = '1066';

    private static $totalBank = [
        self::BANK_CODE_CMB => '招商银行',
        self::BANK_CODE_ICBC => '工商银行',
        self::BANK_CODE_CCB => '建设银行',
        self::BANK_CODE_SPDB => '浦发银行',
        self::BANK_CODE_ABC => '农业银行',
        self::BANK_CODE_CMBC => '民生银行',
        self::BANK_CODE_CIB => '兴业银行',
        self::BANK_CODE_PAB => '平安银行',
        self::BANK_CODE_BCM => '交通银行',
        self::BANK_CODE_ZXB => '中信银行',
        self::BANK_CODE_CEB => '光大银行',
        self::BANK_CODE_HXB => '华夏银行',
        self::BANK_CODE_BOC => '中国银行',
        self::BANK_CODE_GDB => '广发银行',
        self::BANK_CODE_BOB => '北京银行',
        self::BANK_CODE_NBB => '宁波银行',
        self::BANK_CODE_PSBC => '邮储银行',
    ];

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
     * 付款单号
     * @var string
     */
    private $partner_trade_no = '';
    /**
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';
    /**
     * 收款方银行卡号
     * @var string
     */
    private $enc_bank_no = '';
    /**
     * 收款方用户名
     * @var string
     */
    private $enc_true_name = '';
    /**
     * 收款方开户行
     * @var string
     */
    private $bank_code = '';
    /**
     * 付款金额
     * @var int
     */
    private $amount = 0;
    /**
     * 付款说明
     * @var string
     */
    private $desc = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaysptrans/pay_bank';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->appid = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
    }

    private function __clone()
    {
    }

    /**
     * @param string $partnerTradeNo
     * @throws \SyException\Wx\WxException
     */
    public function setPartnerTradeNo(string $partnerTradeNo)
    {
        if (ctype_digit($partnerTradeNo) && (strlen($partnerTradeNo) <= 32)) {
            $this->reqData['partner_trade_no'] = $partnerTradeNo;
        } else {
            throw new WxException('付款单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $bankCode
     * @param string $accountNo
     * @param string $accountName
     * @throws \SyException\Wx\WxException
     */
    public function setBankInfo(string $bankCode, string $accountNo, string $accountName)
    {
        if (!isset(self::$totalBank[$bankCode])) {
            throw new WxException('收款方开户行不支持', ErrorCode::WX_PARAM_ERROR);
        }
        if (strlen($accountNo) > 32) {
            throw new WxException('收款方银行卡号不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif (!ctype_alnum($accountNo)) {
            throw new WxException('收款方银行卡号不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if (strlen($accountName) == 0) {
            throw new WxException('收款方用户名不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif (mb_strlen($accountName) > 50) {
            throw new WxException('收款方用户名不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $encryptData = WxUtilPayment::encryptRsaCompanyBank($this->appid, [
            'account_no' => $accountNo,
            'account_name' => $accountName,
        ]);
        $this->reqData['enc_bank_no'] = $encryptData['account_no'];
        $this->reqData['enc_true_name'] = $encryptData['account_name'];
        $this->reqData['bank_code'] = $bankCode;
    }

    /**
     * @param int $amount
     * @throws \SyException\Wx\WxException
     */
    public function setAmount(int $amount)
    {
        if (($amount > 0) && ($amount <= 2000000)) {
            $this->reqData['amount'] = $amount;
        } else {
            throw new WxException('付款金额不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $desc
     */
    public function setDesc(string $desc)
    {
        if (strlen($desc) > 0) {
            $this->reqData['desc'] = mb_substr($desc, 0, 50);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['partner_trade_no'])) {
            throw new WxException('付款单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['enc_bank_no'])) {
            throw new WxException('银行信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['amount'])) {
            throw new WxException('付款金额不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->appid);

        $resArr = [
            'code' => 0,
        ];

        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($this->appid);
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
        if ($sendData['return_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } elseif ($sendData['result_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['wx_code'] = $sendData['err_code'];
            $resArr['message'] = $sendData['err_code_des'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
