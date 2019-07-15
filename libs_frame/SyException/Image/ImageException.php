<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-16
 * Time: 下午10:29
 */
namespace SyException\Image;

use SyException\BaseException;

class ImageException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '图片异常';
    }
}
