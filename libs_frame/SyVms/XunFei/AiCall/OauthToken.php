<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/17 0017
 * Time: 16:42
 */
namespace SyVms\XunFei\AiCall;

use DesignPatterns\Singletons\VmsConfigSingleton;
use SyVms\BaseXunFeiAiCall;

/**
 * 获取token
 *
 * @package SyVms\XunFei\AiCall
 */
class OauthToken extends BaseXunFeiAiCall
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://callapi.xfyun.cn/v1/service/v1/aicall/oauth/v1/token';
        $this->reqHeaders['Cache-Control'] = 'no-cache';

        $config = VmsConfigSingleton::getInstance()->getXunFeiConfig();
        $this->reqData = [
            'app_key' => $config->getApiKey(),
            'app_secret' => $config->getApiSecret(),
        ];
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->getContent();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;

        return $this->curlConfigs;
    }
}
