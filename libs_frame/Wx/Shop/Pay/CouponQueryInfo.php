<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/12 0012
 * Time: 15:44
 */
namespace Wx\Shop\Pay;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class CouponQueryInfo extends WxBaseShop {
    /**
     * 代金券id
     * @var string
     */
    private $coupon_id = '';
    /**
     * 用户openid
     * @var string
     */
    private $openid = '';
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
     * 批次号
     * @var string
     */
    private $stock_id = '';
    /**
     * 操作员
     * @var string
     */
    private $op_user_id = '';
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
     * 协议版本
     * @var string
     */
    private $version = '';
    /**
     * 协议类型
     * @var string
     */
    private $type = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/querycouponsinfo';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['appid'] = $shopConfig->getAppId();
        $this->reqData['mch_id'] = $shopConfig->getPayMchId();
        $this->reqData['op_user_id'] = $shopConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['version'] = '1.0';
        $this->reqData['type'] = 'XML';
    }

    private function __clone(){
    }

    /**
     * @param string $couponId
     * @throws \Exception\Wx\WxException
     */
    public function setCouponId(string $couponId){
        if(ctype_digit($couponId)){
            $this->reqData['coupon_id'] = $couponId;
        } else {
            throw new WxException('代金券id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $openid
     * @throws \Exception\Wx\WxException
     */
    public function setOpenid(string $openid){
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->reqData['openid'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $stockId
     * @throws \Exception\Wx\WxException
     */
    public function setStockId(string $stockId){
        if(ctype_digit($stockId) && (strlen($stockId) <= 64)){
            $this->reqData['stock_id'] = $stockId;
        } else {
            throw new WxException('批次号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $opUserId
     * @throws \Exception\Wx\WxException
     */
    public function setOpUserId(string $opUserId){
        if(ctype_digit($opUserId)){
            $this->reqData['op_user_id'] = $opUserId;
        } else {
            throw new WxException('操作员不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $deviceInfo
     */
    public function setDeviceInfo(string $deviceInfo){
        if(strlen($deviceInfo) > 0){
            $this->reqData['device_info'] = $deviceInfo;
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['coupon_id'])){
            throw new WxException('代金券id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['openid'])){
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if(!isset($this->reqData['stock_id'])){
            throw new WxException('批次号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->reqData['appid']);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::xmlToArray($sendRes);
        if ($sendData['return_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } else if ($sendData['result_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}