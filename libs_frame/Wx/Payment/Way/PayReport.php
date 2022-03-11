<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/12 0012
 * Time: 9:43
 */

namespace Wx\Payment\Way;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class PayReport extends WxBasePayment
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
     * 接口URL
     *
     * @var string
     */
    private $interface_url = '';
    /**
     * 访问接口IP
     *
     * @var string
     */
    private $user_ip = '';
    /**
     * 上报数据包
     *
     * @var string
     */
    private $trades = '';

    public function __construct(string $appId, string $merchantType = self::MERCHANT_TYPE_SELF)
    {
        parent::__construct();

        if (!isset(self::$totalMerchantType[$merchantType])) {
            throw new WxException('商户类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/payitil/report';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->merchantType = $merchantType;
        $this->setAppIdAndMchId($accountConfig);
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['interface_url'] = 'https://api.mch.weixin.qq.com/pay/batchreport/micropay/total';
        $this->reqData['user_ip'] = $accountConfig->getClientIp();
    }

    private function __clone()
    {
        //do nothing
    }

    public function setDeviceInfo(string $deviceInfo)
    {
        if (\strlen($deviceInfo) > 0) {
            $this->reqData['device_info'] = $deviceInfo;
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTrades(array $trades)
    {
        if (empty($trades)) {
            throw new WxException('上报数据包不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['trades'] = Tool::jsonEncode($trades, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['trades'])) {
            throw new WxException('上报数据包不能为空', ErrorCode::WX_PARAM_ERROR);
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
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } elseif ('FAIL' == $sendData['result_code']) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = '上报失败';
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
