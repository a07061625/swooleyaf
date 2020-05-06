<?php
/**
 * 发送语音验证码
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:54
 */
namespace SyVms\QCloud;

use SyVms\VmsBaseQCloud;

/**
 * Class CodeVoiceSend
 * @package SyVms\QCloud
 */
class CodeVoiceSend extends VmsBaseQCloud
{
    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->curlConfigs;
    }
}
