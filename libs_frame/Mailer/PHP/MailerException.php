<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-6-30
 * Time: 下午10:09
 */
namespace Mailer\PHP;

class MailerException extends \Exception
{
    /**
     * Prettify error message output
     * @return string
     */
    public function errorMessage()
    {
        return '<strong>' . $this->getMessage() . "</strong><br />\n";
    }
}
