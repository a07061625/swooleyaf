<?php
/**
 * 请求单次分账
 * User: 姜伟
 * Date: 2019/5/17 0017
 * Time: 15:55
 */

namespace Wx\Payment\ProfitSharing;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class Apply extends WxBasePayment
{
    /**
     * 商户号
     *
     * @var string
     */
    private $mch_id = '';
    /**
     * 子商户号
     *
     * @var string
     */
    private $sub_mch_id = '';
    /**
     * 公众账号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 子商户公众账号ID
     *
     * @var string
     */
    private $sub_appid = '';
    /**
     * 微信单号
     *
     * @var string
     */
    private $transaction_id = '';
    /**
     * 商户分账单号
     *
     * @var string
     */
    private $out_order_no = '';
    /**
     * 分账接收方列表
     *
     * @var array
     */
    private $receivers = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/secapi/pay/profitsharing';
        $this->merchantType = self::MERCHANT_TYPE_SUB;
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->setAppIdAndMchId($accountConfig);
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['sign_type'] = 'HMAC-SHA256';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTransactionId(string $transactionId)
    {
        if (ctype_digit($transactionId)) {
            $this->reqData['transaction_id'] = $transactionId;
        } else {
            throw new WxException('微信单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutOrderNo(string $outOrderNo)
    {
        if (ctype_digit($outOrderNo) && (\strlen($outOrderNo) <= 32)) {
            $this->reqData['out_order_no'] = $outOrderNo;
        } else {
            throw new WxException('商户分账单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addReceiver(array $receiver)
    {
        if (empty($receiver)) {
            throw new WxException('分账接收方不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->receivers[] = $receiver;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['transaction_id'])) {
            throw new WxException('微信单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['out_order_no'])) {
            throw new WxException('商户分账单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->receivers)) {
            throw new WxException('分账接收方不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['receivers'] = Tool::jsonEncode($this->receivers, JSON_UNESCAPED_UNICODE);
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid'], 'sha256');

        $resArr = [
            'code' => 0,
        ];

        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($this->reqData['appid']);
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
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } elseif ('FAIL' == $sendData['result_code']) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        }
        $resArr['data'] = $sendData;

        return $resArr;
    }
}
