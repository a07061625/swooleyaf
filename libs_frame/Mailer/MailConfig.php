<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/30 0030
 * Time: 10:27
 */
namespace Mailer;

use Mailer\Configs\Smtp;
use Tool\Tool;

class MailConfig {
    /**
     * @var MailConfig
     */
    private static $instance = null;
    /**
     * smtp配置数组
     * @var array
     */
    private $smtpConfigs = [];

    private function __construct() {
        $this->init();
    }

    private function __clone() {
    }

    private function init() {
        $configs = Tool::getConfig('email.' . SY_ENV . SY_PROJECT);
        foreach ($configs['smtp'] as $node => $config) {
            $smtp = new Smtp();
            $smtp->setHost($config['host']);
            $smtp->setPort($config['port']);
            $smtp->setUser($config['user']);
            $smtp->setPwd($config['pwd']);
            $this->smtpConfigs[$node] = $smtp;
        }
    }

    /**
     * @return \Mailer\MailConfig
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取smtp配置
     * @param string $node 节点标识
     * @return \Mailer\Configs\Smtp|null
     */
    public function getSmtpConfig(string $node) {
        return $this->smtpConfigs[$node] ?? null;
    }
}