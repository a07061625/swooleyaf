<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/19 0019
 * Time: 8:47
 */
namespace SyLogistics;

abstract class LogisticsBaseKd100 extends LogisticsBase
{
    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        return $this->curlConfigs;
    }
}
