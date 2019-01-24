<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/4 0004
 * Time: 21:02
 */
namespace DesignPatterns\Singletons;

use AliOss\ConfigOss;
use AliOss\OssClient;
use Constant\ErrorCode;
use Exception\AliOss\OssException;
use Log\Log;
use Tool\Tool;
use Traits\SingletonTrait;

class AliOssSingleton {
    use SingletonTrait;
    /**
     * @var \AliOss\ConfigOss
     */
    private $ossConfig = null;
    /**
     * @var \AliOss\OssClient
     */
    private $ossClient = null;

    private function __construct(){
        $configs = Tool::getConfig('oss.' . SY_ENV . SY_PROJECT);
        $ossConfig = new ConfigOss();
        $ossConfig->setAccessKeyId((string)Tool::getArrayVal($configs, 'access.key.id', '', true));
        $ossConfig->setAccessKeySecret((string)Tool::getArrayVal($configs, 'access.key.secret', '', true));
        $ossConfig->setEndpoint((string)Tool::getArrayVal($configs, 'endpoint', '', true));
        $ossConfig->setBucketName((string)Tool::getArrayVal($configs, 'bucket.name', '', true));
        $ossConfig->setBucketDomain((string)Tool::getArrayVal($configs, 'bucket.domain', '', true));
        $this->ossConfig = $ossConfig;

        $initType = (int)Tool::getArrayVal($configs, 'init.type', 1, true);
        $securityToken = (string)Tool::getArrayVal($configs, 'security.token', '', true);
        $requestProxy = (string)Tool::getArrayVal($configs, 'request.proxy', '', true);
        $networkTimeoutTransmission = (int)Tool::getArrayVal($configs, 'network.timeout.transmission', 3600, true);
        $networkTimeoutConnect = (int)Tool::getArrayVal($configs, 'network.timeout.connect', 3, true);

        try {
            switch ($initType) {
                case 1:
                    $ossClient = new OssClient($ossConfig->getAccessKeyId(), $ossConfig->getAccessKeySecret(), $ossConfig->getEndpoint());
                    break;
                case 2:
                    $ossClient = new OssClient($ossConfig->getAccessKeyId(), $ossConfig->getAccessKeySecret(), $ossConfig->getEndpoint(), true);
                    break;
                case 3:
                    if(strlen($securityToken) == 0){
                        throw new OssException('加密令牌不能为空', ErrorCode::ALIOSS_PARAM_ERROR);
                    }
                    $ossClient = new OssClient($ossConfig->getAccessKeyId(), $ossConfig->getAccessKeySecret(), $ossConfig->getEndpoint(), false, $securityToken);
                    break;
                case 4:
                    if(strlen($requestProxy) == 0){
                        throw new OssException('代理地址不能为空', ErrorCode::ALIOSS_PARAM_ERROR);
                    }
                    $ossClient = new OssClient($ossConfig->getAccessKeyId(), $ossConfig->getAccessKeySecret(), $ossConfig->getEndpoint(), false, null, $requestProxy);
                    break;
                default:
                    throw new OssException('初始化类型不支持', ErrorCode::ALIOSS_PARAM_ERROR);
            }

            $ossClient->setTimeout($networkTimeoutTransmission);
            $ossClient->setConnectTimeout($networkTimeoutConnect);
            $this->ossClient = $ossClient;
        } catch (\Exception $e) {
            $this->ossConfig = null;
            $this->ossClient = null;
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
            throw new OssException($e->getMessage(), ErrorCode::ALIOSS_CONNECT_ERROR);
        }
    }

    private function __clone(){
    }

    /**
     * @return \DesignPatterns\Singletons\AliOssSingleton
     */
    public static function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \AliOss\ConfigOss
     */
    public function getOssConfig() {
        return $this->ossConfig;
    }

    /**
     * @return \AliOss\OssClient
     */
    public function getOssClient() {
        return $this->ossClient;
    }
}