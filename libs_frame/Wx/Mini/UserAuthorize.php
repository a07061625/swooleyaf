<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 17:05
 */
namespace Wx\Mini;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilBase;

class UserAuthorize extends WxBaseMini
{
    /**
     * @var string
     */
    private $code = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/sns/jscode2session';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['secret'] = $accountConfig->getSecret();
        $this->reqData['grant_type'] = 'authorization_code';
    }

    public function __clone()
    {
    }

    /**
     * @param string $code
     * @throws \SyException\Wx\WxException
     */
    public function setCode(string $code)
    {
        if (strlen($code) > 0) {
            $this->reqData['js_code'] = $code;
        } else {
            throw new WxException('授权码不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['js_code'])) {
            throw new WxException('授权码不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['openid'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
