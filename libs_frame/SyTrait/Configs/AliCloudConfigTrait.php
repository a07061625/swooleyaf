<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/8/11 0011
 * Time: 22:16
 */

namespace SyTrait\Configs;

use AlibabaCloud\Client\AlibabaCloud;
use SyCloud\Ali\ConfigTrait;

/**
 * Trait AliCloudConfigTrait
 *
 * @package SyTrait\Configs
 */
trait AliCloudConfigTrait
{
    public static function clearAliClients()
    {
        AlibabaCloud::flush();
    }

    /**
     * @param \SyCloud\Ali\ConfigTrait $config 客户端配置
     *
     * @throws \AlibabaCloud\Client\Exception\ClientException
     */
    private function setAliClient(ConfigTrait $config)
    {
        $client = AlibabaCloud::accessKeyClient($config->getAccessKey(), $config->getAccessSecret())
            ->regionId($config->getRegionId())
            ->debug($config->isDebugTag());
        if (null !== $config->getVerifyInfo()) {
            $client->verify($config->getVerifyInfo());
        }
        $proxyInfo = $config->getProxyInfo();
        if (\is_string($proxyInfo) && (\strlen($proxyInfo) > 0)) {
            $client->proxy($proxyInfo);
        } elseif (\is_array($proxyInfo) && !empty($proxyInfo)) {
            $client->proxy($proxyInfo);
        }
        if (!empty($config->getCertInfo())) {
            $client->cert($config->getCertInfo());
        }
        if ($config->getConnectTimeout() > 0) {
            $client->connectTimeoutMilliseconds($config->getConnectTimeout());
        }
        if ($config->getTimeout() > 0) {
            $client->timeoutMilliseconds($config->getTimeout());
        }
        AlibabaCloud::set($config->getAccessKey(), $client);
    }

    /**
     * @throws \AlibabaCloud\Client\Exception\ClientException
     */
    private function removeAliClient(string $clientName)
    {
        AlibabaCloud::del($clientName);
    }
}
