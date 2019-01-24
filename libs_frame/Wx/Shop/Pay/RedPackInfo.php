<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/11 0011
 * Time: 20:08
 */
namespace Wx\Shop\Pay;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class RedPackInfo extends WxBaseShop {
    /**
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';
    /**
     * 商户订单号
     * @var string
     */
    private $mch_billno = '';
    /**
     * 商户号
     * @var string
     */
    private $mch_id = '';
    /**
     * 公众账号app id
     * @var string
     */
    private $appid = '';
    /**
     * 订单类型
     * @var string
     */
    private $bill_type = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/gethbinfo';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['mch_id'] = $shopConfig->getPayMchId();
        $this->reqData['appid'] = $shopConfig->getAppId();
        $this->reqData['bill_type'] = 'MCHT';
    }
    private function __clone(){
    }

    /**
     * @param string $mchBillNo
     * @throws \Exception\Wx\WxException
     */
    public function setMchBillNo(string $mchBillNo){
        if(ctype_alnum($mchBillNo) && (strlen($mchBillNo) <= 32)){
            $this->reqData['mch_billno'] = $mchBillNo;
        } else {
            throw new WxException('商户订单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array{
        if(!isset($this->reqData['mch_billno'])){
            throw new WxException('商户订单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->reqData['appid']);

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
        } else if ($sendData['result_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code_des'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}