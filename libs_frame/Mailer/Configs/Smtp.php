<?php
namespace Mailer\Configs;

use Constant\ErrorCode;
use Exception\Mail\MailException;

class Smtp {
    public function __construct() {
    }

    private function __clone() {
    }

    /**
     * 域名
     * @var string
     */
    private $host = '';
    /**
     * 端口
     * @var int
     */
    private $port = 0;
    /**
     * 用户名
     * @var string
     */
    private $user = '';
    /**
     * 密码
     * @var string
     */
    private $pwd = '';

    /**
     * @return string
     */
    public function getHost() : string {
        return $this->host;
    }

    /**
     * @param string $host
     * @throws \Exception\Mail\MailException
     */
    public function setHost(string $host) {
        $trueHost = preg_replace('/\s+/', '', $host);
        if(strlen($trueHost) > 0){
            $this->host = $host;
        } else {
            throw new MailException('域名不合法', ErrorCode::MAIL_PARAM_ERROR);
        }
    }

    /**
     * @return int
     */
    public function getPort() : int {
        return $this->port;
    }

    /**
     * @param int $port
     * @throws \Exception\Mail\MailException
     */
    public function setPort(int $port) {
        if(($port > 0) && ($port < 65536)){
            $this->port = $port;
        } else {
            throw new MailException('端口不合法', ErrorCode::MAIL_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getUser() : string {
        return $this->user;
    }

    /**
     * @param string $user
     * @throws \Exception\Mail\MailException
     */
    public function setUser(string $user) {
        if(preg_match('/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $user) > 0){
            $this->user = $user;
        } else {
            throw new MailException('用户名不合法', ErrorCode::MAIL_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPwd() : string {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     * @throws \Exception\Mail\MailException
     */
    public function setPwd(string $pwd) {
        if(strlen($pwd) > 0){
            $this->pwd = $pwd;
        } else {
            throw new MailException('密码不能为空', ErrorCode::MAIL_PARAM_ERROR);
        }
    }
}