<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/28 0028
 * Time: 10:39
 */
namespace Mailer;

use SyConstant\ErrorCode;
use SyException\Mail\MailException;

class ConfigSmtp
{
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

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getHost() : string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @throws \SyException\Mail\MailException
     */
    public function setHost(string $host)
    {
        $trueHost = preg_replace('/\s+/', '', $host);
        if (strlen($trueHost) > 0) {
            $this->host = $trueHost;
        } else {
            throw new MailException('域名不合法', ErrorCode::MAIL_PARAM_ERROR);
        }
    }

    /**
     * @return int
     */
    public function getPort() : int
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @throws \SyException\Mail\MailException
     */
    public function setPort(int $port)
    {
        if (($port > 0) && ($port < 65536)) {
            $this->port = $port;
        } else {
            throw new MailException('端口不合法', ErrorCode::MAIL_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getUser() : string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @throws \SyException\Mail\MailException
     */
    public function setUser(string $user)
    {
        if (preg_match('/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $user) > 0) {
            $this->user = $user;
        } else {
            throw new MailException('用户名不合法', ErrorCode::MAIL_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPwd() : string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     * @throws \SyException\Mail\MailException
     */
    public function setPwd(string $pwd)
    {
        if (strlen($pwd) > 0) {
            $this->pwd = $pwd;
        } else {
            throw new MailException('密码不能为空', ErrorCode::MAIL_PARAM_ERROR);
        }
    }
}
