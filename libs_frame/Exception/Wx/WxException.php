<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-3-31
 * Time: 上午11:14
 */
namespace Exception\Wx;

use Exception\BaseException;

class WxException extends BaseException {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
        $this->tipName = '微信异常';
    }
}