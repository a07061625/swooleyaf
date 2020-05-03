<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-11
 * Time: 下午11:22
 */
namespace Wx\Payment\Order;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class DownloadBill extends WxBasePayment
{
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
     * 设备号
     * @var string
     */
    private $device_info = '';
    /**
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';
    /**
     * 签名类型
     * @var string
     */
    private $sign_type = '';
    /**
     * 对账单日期
     * @var string
     */
    private $bill_date = '';
    /**
     * 账单类型
     * @var string
     */
    private $bill_type = '';
    /**
     * 压缩账单
     * @var string
     */
    private $tar_type = '';
    /**
     * 输出文件全名
     * @var string
     */
    private $output_file = '';

    public function __construct(string $appId, string $merchantType = self::MERCHANT_TYPE_SELF)
    {
        parent::__construct();

        if (!isset(self::$totalMerchantType[$merchantType])) {
            throw new WxException('商户类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/pay/downloadbill';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->merchantType = $merchantType;
        $this->setAppIdAndMchId($accountConfig);
        $this->reqData['sign_type'] = 'MD5';
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['tar_type'] = 'GZIP';
        $this->reqData['bill_type'] = 'ALL';
    }

    public function __clone()
    {
    }

    /**
     * @param string $deviceInfo
     */
    public function setDeviceInfo(string $deviceInfo)
    {
        if (strlen($deviceInfo) > 0) {
            $this->reqData['device_info'] = $deviceInfo;
        }
    }

    /**
     * @param string $billDate
     * @throws \SyException\Wx\WxException
     */
    public function setBillDate(string $billDate)
    {
        if (ctype_digit($billDate) && (strlen($billDate) == 8)) {
            $this->reqData['bill_date'] = $billDate;
        } else {
            throw new WxException('对账单日期不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $billType
     * @throws \SyException\Wx\WxException
     */
    public function setBillType(string $billType)
    {
        if (in_array($billType, ['ALL', 'SUCCESS', 'REFUND', 'RECHARGE_REFUND'], true)) {
            $this->reqData['bill_type'] = $billType;
        } else {
            throw new WxException('账单类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $outputFile
     */
    public function setOutputFile(string $outputFile)
    {
        if (strlen($outputFile) > 0) {
            $this->output_file = $outputFile;
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['bill_date'])) {
            throw new WxException('对账单日期不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (strlen($this->output_file) == 0) {
            throw new WxException('输出文件不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid']);

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        if (substr($sendRes, 0, 5) == '<xml>') {
            $sendData = Tool::xmlToArray($sendRes);
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } else {
            file_put_contents($this->output_file, $sendRes);

            $resArr['data'] = [
                'return_code' => 'SUCCESS',
            ];
        }

        return $resArr;
    }
}
