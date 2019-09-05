<?php
/**
 * 请求多次分账
 * User: 姜伟
 * Date: 2019/5/17 0017
 * Time: 15:55
 */
namespace Wx\Shop\Pay;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class ProfitSharingApplyMulti extends WxBaseShop
{
    /**
     * 商户号
     * @var string
     */
    private $mch_id = '';
    /**
     * 子商户号
     * @var string
     */
    private $sub_mch_id = '';
    /**
     * 公众账号ID
     * @var string
     */
    private $appid = '';
    /**
     * 子商户公众账号ID
     * @var string
     */
    private $sub_appid = '';
    /**
     * 微信单号
     * @var string
     */
    private $transaction_id = '';
    /**
     * 商户分账单号
     * @var string
     */
    private $out_order_no = '';
    /**
     * 分账接收方列表
     * @var array
     */
    private $receivers = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/secapi/pay/multiprofitsharing';
        $this->merchantType = self::MERCHANT_TYPE_SUB;
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->setAppIdAndMchId($shopConfig);
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['sign_type'] = 'HMAC-SHA256';
    }

    private function __clone()
    {
    }

    /**
     * @param string $transactionId
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
     * @param string $outOrderNo
     * @throws \SyException\Wx\WxException
     */
    public function setOutOrderNo(string $outOrderNo)
    {
        if (ctype_digit($outOrderNo) && (strlen($outOrderNo) <= 32)) {
            $this->reqData['out_order_no'] = $outOrderNo;
        } else {
            throw new WxException('商户分账单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $receiver
     * @throws \SyException\Wx\WxException
     */
    public function addReceiver(array $receiver)
    {
        if (empty($receiver)) {
            throw new WxException('分账接收方不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->receivers[] = $receiver;
    }

    public function getDetail() : array
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
        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->reqData['appid'], 'sha256');

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
        } elseif ($sendData['result_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        }
        $resArr['data'] = $sendData;

        return $resArr;
    }
}
