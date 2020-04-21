<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/4/21 0021
 * Time: 14:03
 */
namespace SyCredit;

use DesignPatterns\Singletons\CreditConfigSingleton;

/**
 * Class BaseMaiLe
 * @package SyCredit
 */
abstract class BaseMaiLe extends BaseCommon
{
    public function __construct()
    {
        parent::__construct();
        $this->reqData['appKey'] = CreditConfigSingleton::getInstance()->getMaiLeConfig()->getAppKey();
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 3000;
        }
        return $this->curlConfigs;
    }
}
