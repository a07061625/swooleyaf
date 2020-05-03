<?php
/**
 * 查询分账结果
 * User: 姜伟
 * Date: 2019/5/17 0017
 * Time: 15:55
 */
namespace Wx\Payment\ProfitSharing;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class Query extends WxBasePayment
{
    /**
     * 商户号
     * @var string
     */
    private $mch_id = '';
    /**
     * 公众账号ID
     * @var string
     */
    private $appid = '';
    /**
     * 子商户号
     * @var string
     */
    private $sub_mch_id = '';
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

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/pay/profitsharingquery';
        $this->merchantType = self::MERCHANT_TYPE_SUB;
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->setAppIdAndMchId($accountConfig);
        $this->appid = $this->reqData['appid'];
        unset($this->reqData['sub_appid']);
        unset($this->reqData['appid']);
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['transaction_id'])) {
            throw new WxException('微信单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['out_order_no'])) {
            throw new WxException('商户分账单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->appid, 'sha256');

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
        }
        $resArr['data'] = $sendData;

        return $resArr;
    }
}
