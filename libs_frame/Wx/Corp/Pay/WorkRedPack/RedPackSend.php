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
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxUtilBase;
use Wx\WxUtilCorp;

/**
 * 发放企业红包
 *
 * @package Wx\Corp\Pay\WorkRedPack
 */
class RedPackSend extends WxBaseCorp
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
    private $wxappid = '';
    /**
     * 发送者名称
     *
     * @var string
     */
    private $sender_name = '';
    /**
     * 应用id
     *
     * @var int
     */
    private $agentid = 0;
    /**
     * 应用密钥
     *
     * @var string
     */
    private $agentSecret = '';
    /**
     * 发送者头像
     *
     * @var string
     */
    private $sender_header_media_id = '';
    /**
     * 用户openid
     *
     * @var string
     */
    private $re_openid = '';
    /**
     * 付款金额
     *
     * @var int
     */
    private $total_amount = 0;
    /**
     * 红包祝福语
     *
     * @var string
     */
    private $wishing = '';
    /**
     * 活动名称
     *
     * @var string
     */
    private $act_name = '';
    /**
     * 备注
     *
     * @var string
     */
    private $remark = '';
    /**
     * 场景id
     *
     * @var string
     */
    private $scene_id = '';

    private $totalScene = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->totalScene = [
            'PRODUCT_1' => 1,
            'PRODUCT_2' => 1,
            'PRODUCT_3' => 1,
            'PRODUCT_4' => 1,
            'PRODUCT_5' => 1,
            'PRODUCT_6' => 1,
            'PRODUCT_7' => 1,
            'PRODUCT_8' => 1,
        ];
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendworkwxredpack';
        $corpConfig = WxConfigSingleton::getInstance()->getCorpConfig($corpId);
        $agentInfo = $corpConfig->getAgentInfo($agentTag);
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['mch_id'] = $corpConfig->getPayMchId();
        $this->reqData['wxappid'] = $corpConfig->getCorpId();
        $this->reqData['agentid'] = $agentInfo['id'];
        $this->agentSecret = $agentInfo['secret'];
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

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setSenderName(string $senderName)
    {
        if (\strlen($senderName) > 0) {
            $this->reqData['sender_name'] = mb_substr($senderName, 0, 64);
            unset($this->reqData['agentid']);
        } else {
            throw new WxException('发送者名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setSenderHeaderMediaId(string $senderHeaderMediaId)
    {
        $length = \strlen($senderHeaderMediaId);
        if ($length > 128) {
            throw new WxException('发送者头像不合法', ErrorCode::WX_PARAM_ERROR);
        }

        if ($length > 0) {
            $this->reqData['sender_header_media_id'] = $senderHeaderMediaId;
        } else {
            unset($this->reqData['sender_header_media_id']);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setReOpenid(string $openid)
    {
        if (preg_match(ProjectBase::REGEX_WX_OPEN_ID, $openid) > 0) {
            $this->reqData['re_openid'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTotalAmount(int $totalAmount)
    {
        if ($totalAmount >= 100) {
            $this->reqData['total_amount'] = $totalAmount;
        } else {
            throw new WxException('付款金额不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setWishing(string $wishing)
    {
        if (\strlen($wishing) > 0) {
            $this->reqData['wishing'] = mb_substr($wishing, 0, 64);
        } else {
            throw new WxException('红包祝福语不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setActName(string $actName)
    {
        if (\strlen($actName) > 0) {
            $this->reqData['act_name'] = mb_substr($actName, 0, 16);
        } else {
            throw new WxException('活动名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setRemark(string $remark)
    {
        if (\strlen($remark) > 0) {
            $this->reqData['remark'] = mb_substr($remark, 0, 128);
        } else {
            throw new WxException('备注不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setSceneId(string $sceneId)
    {
        if (isset($this->totalScene[$sceneId])) {
            $this->reqData['scene_id'] = $sceneId;
        } else {
            throw new WxException('场景id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['mch_billno'])) {
            throw new WxException('商户订单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['re_openid'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['total_amount'])) {
            throw new WxException('付款金额不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['wishing'])) {
            throw new WxException('红包祝福语不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['act_name'])) {
            throw new WxException('活动名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['remark'])) {
            throw new WxException('备注不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (($this->reqData['total_amount'] >= 20000) && !isset($this->reqData['scene_id'])) {
            throw new WxException('场景id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['workwx_sign'] = WxUtilCorp::createCorpSign($this->reqData, [
            'act_name',
            'mch_billno',
            'mch_id',
            'nonce_str',
            're_openid',
            'total_amount',
            'wxappid',
        ], $this->agentSecret);

        $corpConfig = WxConfigSingleton::getInstance()->getCorpConfig($this->reqData['wxappid']);
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
