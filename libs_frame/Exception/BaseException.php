<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 9:46
 */
namespace Exception;

class BaseException extends \Exception {
    public $tipName = '';

    public function __construct($message, $code) {
        parent::__construct($message, $code);
    }
}