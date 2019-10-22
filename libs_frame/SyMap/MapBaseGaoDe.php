<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-14
 * Time: 下午12:47
 */
namespace SyMap;

use DesignPatterns\Singletons\MapSingleton;

abstract class MapBaseGaoDe extends MapBase
{
    /**
     * 服务uri
     * @var string
     */
    protected $serviceUri = '';
    /**
     * 应用key
     * @var string
     */
    private $key = '';
    /**
     * 服务域名
     * @var string
     */
    private $serviceDomain = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceDomain = 'https://restapi.amap.com/v3';
        $this->key = MapSingleton::getInstance()->getGaoDeConfig()->getKey();
    }

    public function __clone()
    {
    }

    protected function getServiceUrl()
    {
        return $this->serviceDomain . $this->serviceUri;
    }

    protected function getContent() : array
    {
        $this->reqData['key'] = $this->key;
        $this->reqData['output'] = 'JSON';
        MapUtilGaoDe::createSign($this->reqData);
        $this->curlConfigs[CURLOPT_URL] = $this->getServiceUrl() . '?' . http_build_query($this->reqData);
        return $this->curlConfigs;
    }
}
