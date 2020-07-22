<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/7 0007
 * Time: 16:12
 */
namespace SyRequest;

use yii\web\Request;

class SyReq2 extends Request
{
    /**
     * @var \Swoole\Http\Request
     */
    private $_swRequest;

    public function setSwRequest($request) {
        $this->_swRequest = $request;
    }
    public function getSwRequest() {
        return $this->_swRequest;
    }
}
