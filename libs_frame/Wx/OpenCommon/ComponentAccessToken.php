<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午9:39
 */
namespace Wx\OpenCommon;

use SyConstant\ErrorCode;
use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;

class ComponentAccessToken extends WxBaseOpenCommon
{
    /**
     * 校验令牌
     * @var string
     */
    private $verifyTicket = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_component_token';
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $this->reqData['component_appid'] = $openCommonConfig->getAppId();
        $this->reqData['component_appsecret'] = $openCommonConfig->getSecret();
    }

    public function __clone()
    {
    }

    /**
     * @param string $verifyTicket
     * @throws \SyException\Wx\WxOpenException
     */
    public function setVerifyTicket(string $verifyTicket)
    {
        if (strlen($verifyTicket) > 0) {
            $this->reqData['component_verify_ticket'] = $verifyTicket;
        } else {
            throw new WxOpenException('校验令牌不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['component_verify_ticket'])) {
            throw new WxOpenException('校验令牌不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!isset($sendData['component_access_token'])) {
            throw new WxOpenException('获取平台access token失败', ErrorCode::WXOPEN_POST_ERROR);
        }

        $wxExpireTime = (int)$sendData['expires_in'];
        $expireTime = Tool::getNowTime() + $wxExpireTime - 1;
        $redisKey = Project::REDIS_PREFIX_WX_COMPONENT_ACCOUNT . $this->reqData['component_appid'];
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'access_token' => $sendData['component_access_token'],
            'expire_time' => $expireTime,
            'unique_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, $wxExpireTime);

        return $sendData;
    }
}
