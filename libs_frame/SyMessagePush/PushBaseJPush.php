<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 11:03
 */
namespace SyMessagePush;

abstract class PushBaseJPush extends PushBase
{
    const PLATFORM_TYPE_ANDROID = 'android'; //平台类型-android
    const PLATFORM_TYPE_IOS = 'ios'; //平台类型-ios
    const PLATFORM_TYPE_WINPHONE = 'winphone'; //平台类型-winphone
    const PLATFORM_TYPE_ALL = 'all'; //平台类型-all

    public static $totalPlatFormType = [
        self::PLATFORM_TYPE_ANDROID => '安卓',
        self::PLATFORM_TYPE_IOS => '苹果',
        self::PLATFORM_TYPE_WINPHONE => '微软手机',
    ];

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
    /**
     * 标识
     * @var string
     */
    protected $objKey = '';

    public function __construct(string $key)
    {
        parent::__construct();
        $this->objKey = $key;
        $this->reqHeader['Content-Type'] = 'application/json';
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_HEADER] = false;
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
