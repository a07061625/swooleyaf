<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/12 0012
 * Time: 15:44
 */

namespace Wx\Payment\Coupon;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class CouponSend extends WxBasePayment
{
    /**
     * 代金券批次id
     *
     * @var string
     */
    private $coupon_stock_id = '';
    /**
     * openid记录数
     *
     * @var int
     */
    private $openid_count = 0;
    /**
     * 商户单据号
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
     * 操作员
     *
     * @var string
     */
    private $op_user_id = '';
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
     * 协议版本
     *
     * @var string
     */
    private $version = '';
    /**
     * 协议类型
     *
     * @var string
     */
    private $type = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/send_coupon';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['op_user_id'] = $accountConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['openid_count'] = 1;
        $this->reqData['version'] = '1.0';
        $this->reqData['type'] = 'XML';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCouponStockId(string $couponStockId)
    {
        if (ctype_digit($couponStockId) && (\strlen($couponStockId) <= 64)) {
            $this->reqData['coupon_stock_id'] = $couponStockId;
        } else {
            throw new WxException('代金券批次id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPartnerTradeNo(string $partnerTradeNo)
    {
        if (ctype_digit($partnerTradeNo)) {
            $this->reqData['partner_trade_no'] = $this->reqData['mch_id'] . date('Ymd') . $partnerTradeNo;
        } else {
            throw new WxException('商户单据号不合法', ErrorCode::WX_PARAM_ERROR);
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
    public function setOpUserId(string $opUserId)
    {
        if (ctype_digit($opUserId)) {
            $this->reqData['op_user_id'] = $opUserId;
        } else {
            throw new WxException('操作员不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setDeviceInfo(string $deviceInfo)
    {
        if (\strlen($deviceInfo) > 0) {
            $this->reqData['device_info'] = $deviceInfo;
        }
    }

    public function setVersion(string $version)
    {
        if (\strlen($version) > 0) {
            $this->reqData['version'] = $version;
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['coupon_stock_id'])) {
            throw new WxException('代金券批次id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['partner_trade_no'])) {
            throw new WxException('商户单据号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['openid'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid']);

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
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
