<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/27 0027
 * Time: 19:05
 */
namespace SyLive;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyTool\Tool;

/**
 * Class BaseBaiJia
 * @package SyLive
 */
abstract class BaseBaiJia extends Base
{
    protected $serviceDomain = '';
    protected $serviceUri = '';
    protected $partnerId = '';

    public function __construct(string $partnerId)
    {
        parent::__construct();
        $config = LiveConfigSingleton::getInstance()->getBaiJiaConfig($partnerId);
        $this->partnerId = $config->getPartnerId();
        $this->serviceDomain = $config->getApiDomain();
        $this->reqData['partner_id'] = $config->getPartnerId();
        $this->reqData['timestamp'] = Tool::getNowTime();
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = http_build_query($this->reqData);

        return $this->curlConfigs;
    }
}
