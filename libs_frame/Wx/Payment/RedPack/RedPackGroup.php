<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:32
 */

namespace Wx\Payment\RedPack;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class RedPackGroup extends WxBasePayment
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
     * 公众账号app id
     *
     * @var string
     */
    private $wxappid = '';
    /**
     * 商户名称
     *
     * @var string
     */
    private $send_name = '';
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
     * 红包发放总人数
     *
     * @var int
     */
    private $total_num = 0;
    /**
     * 红包金额设置方式
     *
     * @var string
     */
    private $amt_type = '';
    /**
     * 红包祝福语
     *
     * @var string
     */
    private $wishing = '';
    /**
     * Ip地址
     *
     * @var string
     */
    private $client_ip = '';
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
    /**
     * 活动信息
     *
     * @var string
     */
    private $risk_info = '';
    /**
     * 资金授权商户号
     *
     * @var string
     */
    private $consume_mch_id = '';

    private $totalScene = [];

    public function __construct(string $appId)
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
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendgroupredpack';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['wxappid'] = $accountConfig->getAppId();
        $this->reqData['total_num'] = 1;
        $this->reqData['amt_type'] = 'ALL_RAND';
        $this->reqData['client_ip'] = $accountConfig->getClientIp();
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
    public function setSendName(string $sendName)
    {
        if (\strlen($sendName) > 0) {
            $this->reqData['send_name'] = mb_substr($sendName, 0, 16);
        } else {
            throw new WxException('商户名称不合法', ErrorCode::WX_PARAM_ERROR);
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
        if ($totalAmount > 0) {
            $this->reqData['total_amount'] = $totalAmount;
        } else {
            throw new WxException('付款金额不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTotalNum(int $totalNum)
    {
        if ($totalNum > 0) {
            $this->reqData['total_num'] = $totalNum;
        } else {
            throw new WxException('红包发放总人数不合法', ErrorCode::WX_PARAM_ERROR);
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

    public function setRiskInfo(array $riskInfo)
    {
        $infoStr = '';
        foreach ($riskInfo as $key => $val) {
            if (\in_array($key, ['posttime', 'mobile', 'deviceid', 'clientversion'], true) && (\strlen($val) > 0)) {
                $infoStr .= '&' . $key . '=' . $val;
            }
        }

        if (\strlen($infoStr) > 0) {
            $this->reqData['risk_info'] = urlencode(substr($infoStr, 1));
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setConsumeMchId(string $consumeMchId)
    {
        if (ctype_alnum($consumeMchId) && (\strlen($consumeMchId) <= 32)) {
            $this->reqData['consume_mch_id'] = $consumeMchId;
        } else {
            throw new WxException('资金授权商户号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['mch_billno'])) {
            throw new WxException('商户订单号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['send_name'])) {
            throw new WxException('商户名称不能为空', ErrorCode::WX_PARAM_ERROR);
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
        if ((($this->reqData['total_amount'] < 100) || ($this->reqData['total_amount'] > 20000)) && (!isset($this->reqData['scene_id']))) {
            throw new WxException('场景id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['wxappid']);

        $resArr = [
            'code' => 0,
        ];

        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($this->reqData['wxappid']);
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
