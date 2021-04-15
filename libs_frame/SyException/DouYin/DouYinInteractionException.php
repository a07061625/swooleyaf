<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 13:39
 */

namespace SyException\DouYin;

use SyException\BaseException;

/**
 * Class DouYinInteractionException
 *
 * @package SyException\DouYin
 */
class DouYinInteractionException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '抖音互动异常';
    }
}
