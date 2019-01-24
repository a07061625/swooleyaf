<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/30 0030
 * Time: 10:54
 */
namespace SyMessagePush;

use Constant\ErrorCode;
use DesignPatterns\Singletons\MessagePushConfigSingleton;
use Exception\MessagePush\XinGePushException;
use Tool\Tool;

abstract class PushBaseXinGe extends PushBase {
    /**
     * api接口域名
     * @var string
     */
    protected $apiDomain = '';
    /**
     * api接口路径
     * @var string
     */
    protected $apiPath = '';
    /**
     * api接口方法
     * @var string
     */
    protected $apiMethod = '';
    /**
     * 请求头信息列表
     * @var array
     */
    protected $reqHeaders = [];

    public function __construct(string $platform){
        parent::__construct();
        $this->apiDomain = 'https://openapi.xg.qq.com/v3/';

        if($platform == ConfigXinGe::PLATFORM_TYPE_IOS){
            $config = MessagePushConfigSingleton::getInstance()->getXinGeIosConfig();
        } else if($platform == ConfigXinGe::PLATFORM_TYPE_ANDROID){
            $config = MessagePushConfigSingleton::getInstance()->getXinGeAndroidConfig();
        } else {
            throw new XinGePushException('平台类型不支持', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqHeaders['Authorization'] = 'Basic ' . base64_encode($config->getAppId() . ':' . $config->getAppSecret());
    }

    protected function getContent() : array {
        $this->curlConfigs[CURLOPT_URL] = $this->apiDomain . $this->apiPath . '/' . $this->apiMethod;
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = 'POST';
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [];
        foreach ($this->reqHeaders as $key => $val) {
            $this->curlConfigs[CURLOPT_HTTPHEADER][] = $key . ': ' . $val;
        }
        return $this->curlConfigs;
    }
}