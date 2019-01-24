<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 16:31
 */
namespace Wx\Shop\Pay;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxException;
use Wx\WxBaseShop;
use Wx\WxUtilShop;

class NativeReturn extends WxBaseShop {
    /**
     * 返回状态码
     * @var string
     */
    private $return_code = '';

    /**
     * 返回信息
     * @var string
     */
    private $return_msg = '';

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
     * 微信返回的随机字符串
     * @var string
     */
    private $nonce_str = '';

    /**
     * 预支付ID
     * @var string
     */
    private $prepay_id = '';

    /**
     * 业务结果
     * @var string
     */
    private $result_code = '';

    /**
     * 错误描述
     * @var string
     */
    private $err_code_des = '';

    public function __construct(string $appId){
        parent::__construct();
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['appid'] = $shopConfig->getAppId();
        $this->reqData['mch_id'] = $shopConfig->getPayMchId();
        $this->reqData['result_code'] = 'SUCCESS';
        $this->reqData['return_code'] = 'SUCCESS';
    }

    public function __clone(){
    }

    /**
     * @param string $nonceStr
     * @throws \Exception\Wx\WxException
     */
    public function setNonceStr(string $nonceStr) {
        if(ctype_alnum($nonceStr)){
            $this->reqData['nonce_str'] = $nonceStr;
        } else {
            throw new WxException('随机字符串不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $prepayId
     * @throws \Exception\Wx\WxException
     */
    public function setPrepayId(string $prepayId) {
        if(ctype_alnum($prepayId)){
            $this->reqData['prepay_id'] = $prepayId;
        } else {
            throw new WxException('预支付ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $errDes 返回给用户的错误描述
     * @param string $returnMsg 返回微信的信息
     * @throws \Exception\Wx\WxException
     */
    public function setErrorMsg(string $errDes,string $returnMsg) {
        if (strlen($errDes) == 0) {
            throw new WxException('错误描述不能为空', ErrorCode::WX_PARAM_ERROR);
        } else if (strlen($returnMsg) == 0) {
            throw new WxException('返回信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['return_code'] = 'FAIL';
        $this->reqData['return_msg'] = mb_substr($returnMsg, 0, 40);
        $this->reqData['result_code'] = 'FAIL';
        $this->reqData['err_code_des'] = mb_substr($errDes, 0, 40);
    }

    public function getDetail() : array {
        if($this->reqData['return_code'] == 'SUCCESS'){
            if(!isset($this->reqData['nonce_str'])){
                throw new WxException('随机字符串不能为空', ErrorCode::WX_PARAM_ERROR);
            } else if(!isset($this->reqData['prepay_id'])){
                throw new WxException('预支付ID不能为空', ErrorCode::WX_PARAM_ERROR);
            }
        }
        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->reqData['appid']);
        return $this->reqData;
    }
}