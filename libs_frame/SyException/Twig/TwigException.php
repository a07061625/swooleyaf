<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/23 0023
 * Time: 10:08
 */
namespace SyException\Twig;

use SyException\BaseException;

class TwigException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = 'Twig异常';
    }
}
