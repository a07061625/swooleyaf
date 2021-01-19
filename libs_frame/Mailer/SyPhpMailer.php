<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/30 0030
 * Time: 20:40
 */

namespace Mailer;

use DesignPatterns\Singletons\MailConfigSingleton;
use Mailer\PHP\PHPMailer;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Mail\MailException;
use SyLog\Log;

class SyPhpMailer
{
    const SMTP_DEBUG_MODE_OFF = 0; //smtp debug模式-关闭
    const SMTP_DEBUG_MODE_CLIENT = 1; //smtp debug模式-显示客户端信息
    const SMTP_DEBUG_MODE_CLIENT_AND_SERVER = 2; //smtp debug模式-显示客户端和服务端信息

    /**
     * @var \Mailer\PHP\PHPMailer
     */
    private $mailer;

    public function __construct(string $node)
    {
        $config = MailConfigSingleton::getInstance()->getSmtpConfig($node);
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Host = $config->getHost();
        $this->mailer->Port = $config->getPort();
        $this->mailer->Username = $config->getUser();
        $this->mailer->Password = $config->getPwd();
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->isHTML(true);
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->Debugoutput = 'html';
        $this->mailer->SMTPDebug = self::SMTP_DEBUG_MODE_OFF;
    }

    private function __clone()
    {
    }

    /**
     * 设置调试模式
     *
     * @throws \SyException\Mail\MailException
     */
    public function setDebugMode(int $mode)
    {
        if (\in_array($mode, [self::SMTP_DEBUG_MODE_OFF, self::SMTP_DEBUG_MODE_CLIENT, self::SMTP_DEBUG_MODE_CLIENT_AND_SERVER], true)) {
            $this->mailer->SMTPDebug = $mode;
        } else {
            throw new MailException('debug模式不合法', ErrorCode::MAIL_PARAM_ERROR);
        }
    }

    /**
     * 设置发送者名称和邮箱
     *
     * @throws \Mailer\PHP\MailerException
     * @throws \SyException\Mail\MailException
     */
    public function setSenderNameAndEmail(string $email, string $name)
    {
        if (0 == preg_match(ProjectBase::REGEX_EMAIL, $email)) {
            throw new MailException('发送者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->mailer->setFrom($email, trim($name));
    }

    /**
     * 添加接收者
     *
     * @throws \SyException\Mail\MailException
     */
    public function addReceiver(string $email, string $name)
    {
        if (0 == preg_match(ProjectBase::REGEX_EMAIL, $email)) {
            throw new MailException('接收者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->mailer->addAddress($email, trim($name));
    }

    /**
     * 添加回复者
     *
     * @throws \SyException\Mail\MailException
     */
    public function addReplier(string $email, string $name)
    {
        if (0 == preg_match(ProjectBase::REGEX_EMAIL, $email)) {
            throw new MailException('回复者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->mailer->addReplyTo($email, trim($name));
    }

    /**
     * 添加抄送者
     *
     * @throws \SyException\Mail\MailException
     */
    public function addCC(string $email, string $name)
    {
        if (0 == preg_match(ProjectBase::REGEX_EMAIL, $email)) {
            throw new MailException('抄送者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->mailer->addCC($email, trim($name));
    }

    /**
     * 添加密送者
     *
     * @throws \SyException\Mail\MailException
     */
    public function addBCC(string $email, string $name)
    {
        if (0 == preg_match(ProjectBase::REGEX_EMAIL, $email)) {
            throw new MailException('密送者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->mailer->addBCC($email, trim($name));
    }

    /**
     * 设置邮件标题
     *
     * @throws \SyException\Mail\MailException
     */
    public function setTitle(string $title)
    {
        $trueTitle = trim($title);
        if (0 == \strlen($trueTitle)) {
            throw new MailException('邮件标题不能为空', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->mailer->Subject = $trueTitle;
    }

    /**
     * 设置邮件内容
     */
    public function setBody(string $body)
    {
        $this->mailer->msgHTML(trim($body));
    }

    /**
     * 设置邮件备用内容，当不支持SMTP时候使用
     */
    public function setAltBody(string $alt)
    {
        $this->mailer->AltBody = trim($alt);
    }

    /**
     * 添加附件
     *
     * @throws \SyException\Mail\MailException
     */
    public function addAttachment(string $attach)
    {
        if (!is_file($attach)) {
            throw new MailException('附件必须是文件', ErrorCode::MAIL_PARAM_ERROR);
        }
        if (!is_readable($attach)) {
            throw new MailException('附件不可读', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->mailer->addAttachment($attach);
    }

    /**
     * 发送邮件
     *
     * @return array
     */
    public function sendEmail()
    {
        $sendRes = [
            'code' => 0,
        ];

        $res = $this->mailer->send();
        if (!$res) {
            Log::error('PHP Mailer发送邮件失败,错误信息:' . $this->mailer->ErrorInfo);
            $sendRes['code'] = ErrorCode::MAIL_SEND_FAIL;
            $sendRes['msg'] = $this->mailer->ErrorInfo;
        }

        return $sendRes;
    }
}
