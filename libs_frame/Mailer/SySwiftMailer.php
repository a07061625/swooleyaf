<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/30 0030
 * Time: 20:41
 */
namespace Mailer;

use Constant\ErrorCode;
use Exception\Mail\MailException;
use Log\Log;

class SySwiftMailer {
    /**
     * @var \Swift_Mailer
     */
    private $mailer = null;
    /**
     * @var \Swift_Message
     */
    private $message = null;

    public function __construct(string $node) {
        $config = MailConfig::getInstance()->getSmtpConfig($node);
        if (is_null($config)) {
            throw new MailException('配置不存在', ErrorCode::MAIL_PARAM_ERROR);
        }

        $transport = new \Swift_SmtpTransport();
        $transport->setHost($config->getHost());
        $transport->setPort($config->getPort());
        $transport->setEncryption('ssl');
        $transport->setUsername($config->getUser());
        $transport->setPassword($config->getPwd());
        $this->mailer = new \Swift_Mailer($transport);
        $this->message = new \Swift_Message();
    }

    private function __clone() {
    }

    /**
     * 设置发送者名称和邮箱
     * @param string $email
     * @param string $name
     * @throws \Exception\Mail\MailException
     */
    public function setSenderNameAndEmail(string $email,string $name) {
        $trueName = trim($name);
        if(strlen($trueName) == 0){
            throw new MailException('发送者名称不能为空', ErrorCode::MAIL_PARAM_ERROR);
        } else if(preg_match('/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email) == 0){
            throw new MailException('发送者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->message->setFrom([
            $email => $name,
        ]);
    }

    /**
     * 添加接收者
     * @param string $email
     * @param string $name
     * @throws \Exception\Mail\MailException
     */
    public function addReceiver(string $email,string $name) {
        if(preg_match('/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email) == 0){
            throw new MailException('接收者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->message->addTo($email, trim($name));
    }

    /**
     * 添加回复者
     * @param string $email
     * @param string $name
     * @throws \Exception\Mail\MailException
     */
    public function addReplier(string $email,string $name) {
        if(preg_match('/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email) == 0){
            throw new MailException('回复者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->message->addReplyTo($email, trim($name));
    }

    /**
     * 添加抄送者
     * @param string $email
     * @param string $name
     * @throws \Exception\Mail\MailException
     */
    public function addCC(string $email,string $name) {
        if(preg_match('/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email) == 0){
            throw new MailException('抄送者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->message->addCc($email, trim($name));
    }

    /**
     * 添加密送者
     * @param string $email
     * @param string $name
     * @throws \Exception\Mail\MailException
     */
    public function addBCC(string $email,string $name) {
        if(preg_match('/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email) == 0){
            throw new MailException('密送者邮箱不合法', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->message->addBcc($email, trim($name));
    }

    /**
     * 设置邮件标题
     * @param string $title
     * @throws \Exception\Mail\MailException
     */
    public function setTitle(string $title) {
        $trueTitle = trim($title);
        if (strlen($trueTitle) == 0) {
            throw new MailException('邮件标题不能为空', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->message->setSubject($trueTitle);
    }

    /**
     * 设置邮件内容
     * @param string $body
     * @param string $format
     */
    public function setBody(string $body,string $format='text/html') {
        $this->message->setBody(trim($body), $format);
    }

    /**
     * 添加邮件备用内容
     * @param string $alt
     * @param string $format
     */
    public function addAltBody(string $alt,string $format='text/html') {
        $this->message->addPart(trim($alt), $format);
    }

    /**
     * 添加附件
     * @param string $attach
     * @throws \Exception\Mail\MailException
     */
    public function addAttachment(string $attach) {
        if (!is_file($attach)) {
            throw new MailException('附件必须是文件', ErrorCode::MAIL_PARAM_ERROR);
        } else if (!is_readable($attach)) {
            throw new MailException('附件不可读', ErrorCode::MAIL_PARAM_ERROR);
        }

        $this->message->attach(\Swift_Attachment::fromPath($attach));
    }

    /**
     * 发送邮件
     * @return int
     */
    public function sendEmail() {
        $res = $this->mailer->send($this->message, $failedRecipients);
        if (!$res) {
            Log::error('Swift Mailer发送邮件失败,错误信息:' . print_r($failedRecipients, true));
        }

        return $res;
    }
}