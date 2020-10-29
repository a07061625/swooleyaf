<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/12 0012
 * Time: 9:43
 */
namespace Wx\Account\Tools;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class AuthCodeToOpenid extends WxBaseAccount
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
     * 授权码
     *
     * @var string
     */
    private $auth_code = '';
    /**
     * 随机字符串
     *
     * @var string
     */
    private $nonce_str = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/tools/authcodetoopenid';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
    }

    private function __clone()
    {
    }

    /**
     * @param string $authCode
     *
     * @throws \SyException\Wx\WxException
     */
    public function setAuthCode(string $authCode)
    {
        if (ctype_digit($authCode) && (strlen($authCode) == 18) && ($authCode[0] == '1')) {
            $this->reqData['auth_code'] = $authCode;
        } else {
            throw new WxException('授权码不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['auth_code'])) {
            throw new WxException('授权码不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid']);

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::xmlToArray($sendRes);
        if ($sendData['return_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_msg'];
        } elseif ($sendData['result_code'] == 'FAIL') {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['err_code'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
