<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/28 0028
 * Time: 10:14
 */
namespace SyException\LiveEducation;

use SyException\BaseException;

/**
 * Class BJYException
 * @package SyException\LiveEducation
 */
class BJYException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '百家云教育直播异常';
    }
}
