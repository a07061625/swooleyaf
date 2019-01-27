<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-27
 * Time: 下午1:34
 */
namespace DingDing\Corp\Sso;

use DingDing\TalkBaseCorp;

class SsoToken extends TalkBaseCorp {
    public function __construct(){
        parent::__construct();
    }

    private function __clone(){
    }

    public function getDetail() : array {
    }
}