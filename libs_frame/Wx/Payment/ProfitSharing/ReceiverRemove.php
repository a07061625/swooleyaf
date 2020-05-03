<?php
/**
 * 删除分账接收方
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

class ReceiverRemove extends WxBasePayment
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
     * 分账接收方
     * @var array
     */
    private $receiver = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/pay/profitsharingremovereceiver';
        $this->merchantType = self::MERCHANT_TYPE_SUB;
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->setAppIdAndMchId($accountConfig);
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['sign_type'] = 'HMAC-SHA256';
    }

    private function __clone()
    {
    }

    /**
     * @param array $receiver
     * @throws \SyException\Wx\WxException
     */
    public function setReceiver(array $receiver)
    {
        if (empty($receiver)) {
            throw new WxException('分账接收方不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->receiver = $receiver;
    }

    public function getDetail() : array
    {
        if (empty($this->receiver)) {
            throw new WxException('分账接收方不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['receiver'] = Tool::jsonEncode($this->receiver, JSON_UNESCAPED_UNICODE);
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid'], 'sha256');

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
