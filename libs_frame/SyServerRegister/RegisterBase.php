<?php
/**
 * 服务注册基类
 * User: 姜伟
 * Date: 2020/7/18 0018
 * Time: 21:06
 */
namespace SyServerRegister;

use SyConstant\SyInner;

/**
 * Class RegisterBase
 * @package SyServerRegister
 */
class RegisterBase
{
    /**
     * 注册地址
     * @var string
     */
    protected $url = '';
    /**
     * 注册类型
     * @var string
     */
    protected $registerType = '';
    /**
     * 请求数据
     * @var array
     */
    protected $reqData = [];
    /**
     * 主机名
     * @var string
     */
    private $host = '';
    /**
     * 端口
     * @var int
     */
    private $port = 0;
    /**
     * 权重
     * @var int
     */
    protected $weight = 0;

    public function __construct(string $registerType)
    {
        if (!SyInner::$totalServerRegisterType[$registerType]) {
            die('server register type not supported' . PHP_EOL);
        }

        $this->registerType = $registerType;
        $this->reqData = [];
        $this->weight = 1;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host)
    {
        $trueHost = trim($host);
        if (strlen($trueHost) > 0) {
            $this->reqData['host'] = $trueHost;
        }
    }

    /**
     * @param int $port
     */
    public function setPort(int $port)
    {
        if (($port >= 1024) && ($port <= 65535)) {
            $this->reqData['port'] = $port;
        }
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight)
    {
        if ($weight > 0) {
            $this->weight = $weight;
        }
    }

    protected function checkCommonData()
    {
        if (!isset($this->reqData['host'])) {
            die('server host is empty' . PHP_EOL);
        }
        if (!isset($this->reqData['port'])) {
            die('server port is empty' . PHP_EOL);
        }
    }
}
