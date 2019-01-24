<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:25
 */
namespace DesignPatterns\Singletons;

use Map\ConfigBaiDu;
use Map\ConfigTencent;
use Tool\Tool;
use Traits\SingletonTrait;

class MapSingleton {
    use SingletonTrait;
    /**
     * @var \Map\ConfigBaiDu
     */
    private $baiduConfig = null;
    /**
     * @var \Map\ConfigTencent
     */
    private $tencentConfig = null;

    private function __construct(){
        $configs = Tool::getConfig('map.' . SY_ENV . SY_PROJECT);

        $baiduConfig = new ConfigBaiDu();
        $baiduConfig->setAk((string)Tool::getArrayVal($configs, 'baidu.ak', '', true));
        $baiduConfig->setServerIp((string)Tool::getArrayVal($configs, 'baidu.server.ip', '', true));
        $this->baiduConfig = $baiduConfig;

        $tencentConfig = new ConfigTencent();
        $tencentConfig->setKey((string)Tool::getArrayVal($configs, 'tencent.key', '', true));
        $tencentConfig->setServerIp((string)Tool::getArrayVal($configs, 'tencent.server.ip', '', true));
        $this->tencentConfig = $tencentConfig;
    }

    /**
     * @return \DesignPatterns\Singletons\MapSingleton
     */
    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \Map\ConfigBaiDu
     */
    public function getBaiduConfig() {
        return $this->baiduConfig;
    }

    /**
     * @return \Map\ConfigTencent
     */
    public function getTencentConfig() {
        return $this->tencentConfig;
    }
}