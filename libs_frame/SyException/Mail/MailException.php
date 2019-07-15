<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-3-28
 * Time: 下午6:39
 */
namespace SyException\Mail;

use SyException\BaseException;

class MailException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '邮件异常';
    }
}
