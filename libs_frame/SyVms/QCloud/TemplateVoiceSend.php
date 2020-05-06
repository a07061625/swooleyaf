<?php
/**
 * 指定模板发送语音通知
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:56
 */
namespace SyVms\QCloud;

use SyVms\VmsBaseQCloud;

/**
 * Class TemplateVoiceSend
 * @package SyVms\QCloud
 */
class TemplateVoiceSend extends VmsBaseQCloud
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
