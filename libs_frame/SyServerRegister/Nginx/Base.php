<?php
/**
 * nginx服务注册基类
 * User: 姜伟
 * Date: 2020/7/18 0018
 * Time: 21:07
 */
namespace SyServerRegister\Nginx;

use SyConstant\SyInner;
use SyServerRegister\RegisterBase;
use SyTool\Tool;

/**
 * Class Base
 * @package SyServerRegister\Nginx
 */
abstract class Base extends RegisterBase
{
    /**
     * 最大失败次数
     * @var int
     */
    protected $maxFails = 0;
    /**
     * 失败超时时间,单位为秒
     * @var int
     */
    protected $failTimeout = 0;
    /**
     * 是否为备份服务 0:否 1:是
     * @var int
     */
    protected $backup = 0;
    /**
     * 服务标识
     * @var string
     */
    private $tag = '';

    public function __construct()
    {
        parent::__construct(SyInner::SERVER_REGISTER_TYPE_NGINX);
        $configs = Tool::getConfig('syregister.' . SY_ENV . SY_PROJECT . '.server.nginx');
        $this->url = $configs['url'];
        $this->reqData['name'] = $configs['name'];
        $this->reqData['secret'] = $configs['secret'];
        $this->maxFails = 3;
        $this->failTimeout = 30;
        $this->backup = 0;
    }

    abstract protected function checkData();

    /**
     * @param int $maxFails
     */
    public function setMaxFails(int $maxFails)
    {
        if ($maxFails > 0) {
            $this->maxFails = $maxFails;
        }
    }

    /**
     * @param int $failTimeout
     */
    public function setFailTimeout(int $failTimeout)
    {
        if ($failTimeout > 0) {
            $this->failTimeout = $failTimeout;
        }
    }

    /**
     * @param int $backup
     */
    public function setBackup(int $backup)
    {
        if (in_array($backup, [0, 1], true)) {
            $this->backup = $backup;
        }
    }

    /**
     * @param string $tag
     */
    public function setTag(string $tag) : void
    {
        if (ctype_alnum($tag)) {
            $this->reqData['tag'] = $tag;
        }
    }
}
