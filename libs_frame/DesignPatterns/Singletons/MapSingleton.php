<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:25
 */
namespace DesignPatterns\Singletons;

use SyMap\ConfigBaiDu;
use SyMap\ConfigGaoDe;
use SyMap\ConfigTencent;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class MapSingleton
{
    use SingletonTrait;
    /**
     * @var \SyMap\ConfigBaiDu
     */
    private $baiduConfig = null;
    /**
     * @var \SyMap\ConfigTencent
     */
    private $tencentConfig = null;
    /**
     * @var \SyMap\ConfigGaoDe
     */
    private $gaoDeConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\MapSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyMap\ConfigBaiDu
     */
    public function getBaiduConfig()
    {
        if (is_null($this->baiduConfig)) {
            $configs = Tool::getConfig('map.' . SY_ENV . SY_PROJECT);
            $baiduConfig = new ConfigBaiDu();
            $baiduConfig->setAk((string)Tool::getArrayVal($configs, 'baidu.ak', '', true));
            $baiduConfig->setServerIp((string)Tool::getArrayVal($configs, 'baidu.server.ip', '', true));
            $this->baiduConfig = $baiduConfig;
        }

        return $this->baiduConfig;
    }

    /**
     * @return \SyMap\ConfigTencent
     */
    public function getTencentConfig()
    {
        if (is_null($this->tencentConfig)) {
            $configs = Tool::getConfig('map.' . SY_ENV . SY_PROJECT);
            $tencentConfig = new ConfigTencent();
            $tencentConfig->setKey((string)Tool::getArrayVal($configs, 'tencent.key', '', true));
            $tencentConfig->setServerIp((string)Tool::getArrayVal($configs, 'tencent.server.ip', '', true));
            $tencentConfig->setDomain((string)Tool::getArrayVal($configs, 'tencent.domain', '', true));
            $this->tencentConfig = $tencentConfig;
        }

        return $this->tencentConfig;
    }

    /**
     * @return \SyMap\ConfigGaoDe
     */
    public function getGaoDeConfig()
    {
        if (is_null($this->gaoDeConfig)) {
            $configs = Tool::getConfig('map.' . SY_ENV . SY_PROJECT);
            $gaodeConfig = new ConfigGaoDe();
            $gaodeConfig->setKey((string)Tool::getArrayVal($configs, 'gaode.key', '', true));
            $gaodeConfig->setSecret((string)Tool::getArrayVal($configs, 'gaode.secret', '', true));
            $this->gaoDeConfig = $gaodeConfig;
        }

        return $this->gaoDeConfig;
    }
}
