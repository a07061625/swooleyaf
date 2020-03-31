<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/27 0027
 * Time: 19:05
 */
namespace LiveEducation;

use DesignPatterns\Singletons\LiveEducationConfigSingleton;
use SyTool\Tool;

/**
 * Class BaseBJY
 * @package LiveEducation
 */
abstract class BaseBJY extends BaseCommon
{
    protected $serviceDomain = '';
    protected $serviceUri = '';
    protected $partnerId = '';

    public function __construct(string $partnerId)
    {
        parent::__construct();
        $config = LiveEducationConfigSingleton::getInstance()->getBJYConfig($partnerId);
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
