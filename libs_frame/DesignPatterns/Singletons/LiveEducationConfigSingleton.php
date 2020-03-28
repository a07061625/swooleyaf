<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/28 0028
 * Time: 10:29
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\LiveEducation\BJYException;
use SyTool\Tool;
use SyTrait\LiveEducationConfigTrait;
use SyTrait\SingletonTrait;

/**
 * Class LiveEducationConfigSingleton
 * @package DesignPatterns\Singletons
 */
class LiveEducationConfigSingleton
{
    use SingletonTrait;
    use LiveEducationConfigTrait;

    /**
     * 百家云配置列表
     * @var array
     */
    private $bjyConfigs = [];
    /**
     * 百家云配置清理时间戳
     * @var int
     */
    private $bjyClearTime = 0;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\LiveEducationConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取所有的百家云配置
     * @return array
     */
    public function getBJYConfigs()
    {
        return $this->bjyConfigs;
    }

    /**
     * 获取本地百家云配置
     * @param string $partnerId
     * @return \LiveEducation\ConfigBJY|null
     */
    private function getLocalBJYConfig(string $partnerId)
    {
        $nowTime = Tool::getNowTime();
        if ($this->bjyClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->bjyConfigs as $ePartnerId => $bjyConfig) {
                if ($bjyConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $ePartnerId;
                }
            }
            foreach ($delIds as $ePartnerId) {
                unset($this->bjyConfigs[$ePartnerId]);
            }

            $this->bjyClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_LIVE_EDUCATION_BJY_CLEAR;
        }

        return Tool::getArrayVal($this->bjyConfigs, $partnerId, null);
    }

    /**
     * 获取百家云配置
     * @param string $partnerId
     * @return \LiveEducation\ConfigBJY|null
     * @throws \SyException\LiveEducation\BJYException
     */
    public function getBJYConfig(string $partnerId)
    {
        $nowTime = Tool::getNowTime();
        $bjyConfig = $this->getLocalBJYConfig($partnerId);
        if (is_null($bjyConfig)) {
            $bjyConfig = $this->refreshBJYConfig($partnerId);
        } elseif ($bjyConfig->getExpireTime() < $nowTime) {
            $bjyConfig = $this->refreshBJYConfig($partnerId);
        }

        if ($bjyConfig->isValid()) {
            return $bjyConfig;
        } else {
            throw new BJYException('百家云配置不存在', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * 移除百家云配置
     * @param string $partnerId
     */
    public function removeBJYConfig(string $partnerId)
    {
        unset($this->bjyConfigs[$partnerId]);
    }
}
