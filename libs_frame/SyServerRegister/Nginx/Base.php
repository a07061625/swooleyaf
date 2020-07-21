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
     * 是否下线 0:上线 1:下线
     * @var int
     */
    protected $isDown = 0;

    public function __construct()
    {
        parent::__construct(SyInner::SERVER_REGISTER_TYPE_NGINX);
        $domain = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.domain.main', '', '');
        if (strlen($domain) == 0) {
            system('echo -e "\e[1;31m domain is empty \e[0m"');
            exit();
        }

        $configs = Tool::getConfig('syregister.' . SY_ENV . SY_PROJECT . '.server.nginx');
        $this->url = $domain . $configs['uri'];
        $this->reqData['name'] = $configs['name'];
        $this->reqData['secret'] = $configs['secret'];
        $this->reqData['is_down'] = 0;
    }

    abstract protected function checkData();

    /**
     * @param int $isDown
     */
    public function setIsDown(int $isDown)
    {
        if (in_array($isDown, [0, 1], true)) {
            $this->reqData['is_down'] = $isDown;
        } else {
            system('echo -e "\e[1;31m is_down must be 0 or 1 \e[0m"');
            exit();
        }
    }
}
