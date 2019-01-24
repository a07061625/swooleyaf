<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 10:59
 */
namespace SyFrame;

use Response\Result;
use Tool\SyUser;
use Yaf\Controller_Abstract;

abstract class BaseController extends Controller_Abstract {
    /**
     * @var \Response\Result
     */
    public $SyResult = null;
    /**
     * @var array
     */
    public $user = [];
    /**
     * 接口签名状态
     * @var bool
     */
    public $signStatus = false;

    public function init(){
        $this->SyResult = new Result();
        $this->user = SyUser::getUserInfo(true);
    }

    /**
     * 设置响应数据
     * <pre>
     * data为null,设置响应数据为SyResult
     * data不为null,设置响应数据为data
     * </pre>
     * @param string $data
     */
    public function sendRsp(?string $data=null){
        if(is_null($data)){
            $this->getResponse()->setBody($this->SyResult->getJson());
        } else {
            $this->getResponse()->setBody((string)$data);
        }
    }
}