<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 18:01
 */
namespace QiNiu;

use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

abstract class QiNiuBaseKodo extends QiNiuBase
{
    const REGION_TYPE_HUADONG = 'z0';
    const REGION_TYPE_HUANAN = 'z1';
    const REGION_TYPE_HUABEI = 'z2';
    const REGION_TYPE_BEIMEI = 'na0';
    const REGION_TYPE_DONGNANYA = 'as0';

    protected static $totalRegionType = [
        self::REGION_TYPE_HUADONG => '华东',
        self::REGION_TYPE_HUANAN => '华南',
        self::REGION_TYPE_HUABEI => '华北',
        self::REGION_TYPE_BEIMEI => '北美',
        self::REGION_TYPE_DONGNANYA => '东南亚',
    ];

    /**
     * 服务uri
     * @var string
     */
    protected $serviceUri = '';
    /**
     * 服务域名
     * @var string
     */
    protected $serviceHost = '';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 设置服务域名
     * @param string $host 服务域名
     * @throws \SyException\QiNiu\KodoException
     */
    protected function setServiceHost(string $host)
    {
        if(strlen($host) > 0){
            $this->serviceHost = $host;
            $this->reqHeader['Host'] = $host;
        } else {
            throw new KodoException('服务域名不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_URL] = 'http://' . $this->serviceHost . $this->serviceUri;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $reqHeaderArr = [];
        foreach ($this->reqHeader as $headerKey => $headerVal) {
            $reqHeaderArr[] = $headerKey . ': ' . $headerVal;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = $reqHeaderArr;
        return $this->curlConfigs;
    }
}
