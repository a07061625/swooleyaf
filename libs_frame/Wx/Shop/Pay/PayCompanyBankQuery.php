<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/12 0012
 * Time: 17:08
 */
namespace Wx\Shop\Pay;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class PayCompanyBankQuery extends WxBaseShop {
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
     * 付款单号
     * @var string
     */
    private $partner_trade_no = '';
    /**
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaysptrans/query_bank';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->appid = $shopConfig->getAppId();
        $this->reqData['mch_id'] = $shopConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
    }

    private function __clone(){
    }

    /**
     * @param string $partnerTradeNo
     * @throws \Exception\Wx\WxException
     */
    public function setPartnerTradeNo(string $partnerTradeNo){
        if(ctype_digit($partnerTradeNo) && (strlen($partnerTradeNo) <= 32)){
            $this->reqData['partner_trade_no'] = $partnerTradeNo;
        } else {
            throw new WxException('付款单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['partner_trade_no'])){
            throw new WxException('付款单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->appid);

        $resArr = [
            'code' => 0,
        ];

        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($this->appid);
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