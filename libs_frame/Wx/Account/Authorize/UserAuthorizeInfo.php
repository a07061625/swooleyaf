<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 上午1:32
 */

namespace Wx\Account\Authorize;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\Account\User\InfoBase;
use Wx\Account\User\InfoSingle;
use Wx\WxBaseAccount;
use Wx\WxUtilBase;

class UserAuthorizeInfo extends WxBaseAccount
{
    /**
     * 授权码
     *
     * @var string
     */
    private $code = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['secret'] = $accountConfig->getSecret();
        $this->reqData['grant_type'] = 'authorization_code';
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCode(string $code)
    {
        if (\strlen($code) > 0) {
            $this->reqData['code'] = $code;
        } else {
            throw new WxException('授权码不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['code'])) {
            throw new WxException('授权码不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!isset($sendData['access_token'])) {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];

            return $resArr;
        }

        $openid = $sendData['openid'];
        $infoBase = new InfoBase($this->reqData['appid']);
        $infoBase->setAccessToken($sendData['access_token']);
        $infoBase->setOpenid($openid);
        $infoBaseRes = $infoBase->getDetail();
        if (0 == $infoBase['code']) {
            $resArr['data'] = $infoBaseRes['data'];
        } elseif (40001 == $infoBaseRes['errcode']) {
            $infoSingle = new InfoSingle($this->reqData['appid']);
            $infoSingle->setOpenid($openid);
            $infoSingleRes = $infoSingle->getDetail();
            if ($infoSingleRes['code'] > 0) {
                $resArr['data'] = $infoSingleRes['data'];
            } else {
                $resArr['code'] = ErrorCode::WX_GET_ERROR;
                $resArr['message'] = $infoSingleRes['message'];
            }
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $infoBaseRes['message'];
        }

        return $resArr;
    }
}
