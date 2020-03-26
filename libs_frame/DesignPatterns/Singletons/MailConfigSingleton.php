<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/28 0028
 * Time: 10:36
 */
namespace DesignPatterns\Singletons;

use Mailer\ConfigSmtp;
use SyConstant\ErrorCode;
use SyException\Mail\MailException;
use SyTrait\SingletonTrait;
use SyTool\Tool;

class MailConfigSingleton
{
    use SingletonTrait;

    /**
     * @var array
     */
    private $smtpConfigMap = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\MailConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $node
     * @return \Mailer\ConfigSmtp
     * @throws \SyException\Mail\MailException
     */
    public function getSmtpConfig(string $node)
    {
        if (is_null($this->smtpConfigMap)) {
            $this->smtpConfigMap = [];
            $configs = Tool::getConfig('email.' . SY_ENV . SY_PROJECT);
            foreach ($configs['smtp'] as $node => $config) {
                $smtpConfig = new ConfigSmtp();
                $smtpConfig->setHost($config['host']);
                $smtpConfig->setPort($config['port']);
                $smtpConfig->setUser($config['user']);
                $smtpConfig->setPwd($config['pwd']);
                $this->smtpConfigMap[$node] = $smtpConfig;
            }
        }

        if (isset($this->smtpConfigMap[$node])) {
            return $this->smtpConfigMap[$node];
        } else {
            throw new MailException('SMTP配置不存在', ErrorCode::MAIL_PARAM_ERROR);
        }
    }
}
