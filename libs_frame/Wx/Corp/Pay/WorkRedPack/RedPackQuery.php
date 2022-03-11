<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:32
 */

namespace Wx\Corp\Pay\WorkRedPack;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxUtilBase;
use Wx\WxUtilCorp;

/**
 * 查询红包记录
 *
 * @package Wx\Corp\Pay\WorkRedPack
 */
class RedPackQuery extends WxBaseCorp
{
    /**
     * 随机字符串
     *
     * @var string
     */
    private $nonce_str = '';
    /**
     * 商户订单号
     *
     * @var string
     */
    private $mch_billno = '';
    /**
     * 商户号
     *
     * @var string
     */
    private $mch_id = '';
    /**
     * 企业ID
     *
     * @var string
     */
    private $appid = '';

    public function __construct(string $corpId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/queryworkwxredpack';
        $corpConfig = WxConfigSingleton::getInstance()->getCorpConfig($corpId);
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['mch_id'] = $corpConfig->getPayMchId();
        $this->reqData['appid'] = $corpConfig->getCorpId();
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMchBillNo(string $mchBillNo)
    {
        if (ctype_alnum($mchBillNo) && (\strlen($mchBillNo) <= 32)) {
            $this->reqData['mch_billno'] = $mchBillNo;
        } else {
            throw new WxException('商户订单号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['mch_billno'])) {
            throw new WxException('商户订单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $corpConfig = WxConfigSingleton::getInstance()->getCorpConfig($this->reqData['appid']);
        $this->reqData['sign'] = WxUtilCorp::createWxSign($this->reqData, $corpConfig->getPayKey());

        $resArr = [
            'code' => 0,
        ];

        $tmpKey = tmpfile();
        fwrite($tmpKey, $corpConfig->getSslKey());
        $tmpKeyData = stream_get_meta_data($tmpKey);
        $tmpCert = tmpfile();
        fwrite($tmpCert, $corpConfig->getSslCert());
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
