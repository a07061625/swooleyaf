<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 16:29
 */
namespace SyMessagePush;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\MessagePushConfigSingleton;
use SyException\MessagePush\BaiDuPushException;
use SyTool\Tool;

abstract class PushBaseBaiDu extends PushBase
{
    /**
     * 设备类型
     * @var int
     */
    private $deviceType = 0;
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 服务域名
     * @var string
     */
    protected $serviceDomain = '';
    /**
     * 服务uri
     * @var string
     */
    protected $serviceUri = '';

    public function __construct()
    {
        $nowTime = Tool::getNowTime();
        $config = MessagePushConfigSingleton::getInstance()->getBaiDuConfig();
        $this->reqHeader['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $this->reqHeader['User-Agent'] = $config->getHttpUserAgent();
        $this->reqData['apikey'] = $config->getAppKey();
        $this->reqData['timestamp'] = $nowTime;
        $this->reqData['expires'] = $nowTime + 60;
        if ($config->getDeviceType() == ConfigBaiDu::DEVICE_TYPE_ALL) {
            $this->reqData['device_type'] = ConfigBaiDu::DEVICE_TYPE_ANDROID;
        } else {
            $this->reqData['device_type'] = $config->getDeviceType();
        }
        $this->serviceDomain = 'https://api.tuisong.baidu.com';
        $this->serviceUri = '/rest/3.0';
    }

    /**
     * @param int $deviceType
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setDeviceType(int $deviceType)
    {
        $config = MessagePushConfigSingleton::getInstance()->getBaiDuConfig();
        if ($config->getDeviceType() != ConfigBaiDu::DEVICE_TYPE_ALL) {
            throw new BaiDuPushException('设备类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset(ConfigBaiDu::$totalDeviceType[$deviceType])) {
            throw new BaiDuPushException('设备类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['device_type'] = $deviceType;
    }

    protected function getContent() : array
    {
        $url = $this->serviceDomain . $this->serviceUri;
        $sign = PushUtilBaiDu::createSign([
            'http_method' => 'POST',
            'url' => $url,
            'params' => $this->reqData,
        ]);
        $this->reqData['sign'] = $sign;
        $this->curlConfigs[CURLOPT_URL] = $url;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = http_build_query($this->reqData);
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [];
        foreach ($this->reqHeader as $key => $val) {
            $this->curlConfigs[CURLOPT_HTTPHEADER][] = $key . ':' . $val;
        }
        return $this->curlConfigs;
    }
}
