<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 18:01
 */
namespace SyObjectStorage;

use SyCloud\QiNiu\Base;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;

abstract class BaseKodo extends Base
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
     * 访问账号
     *
     * @var string
     */
    protected $accessKey = '';
    /**
     * 服务uri
     *
     * @var string
     */
    protected $serviceUri = '';
    /**
     * 服务域名
     *
     * @var string
     */
    protected $serviceHost = '';

    public function __construct(string $accessKey)
    {
        parent::__construct();
        $this->accessKey = $accessKey;
    }

    /**
     * 设置服务域名
     *
     * @param string $host 服务域名
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    protected function setServiceHost(string $host)
    {
        if (strlen($host) > 0) {
            $this->serviceHost = $host;
            $this->reqHeader['Host'] = $host;
        } else {
            throw new KodoException('服务域名不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
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
