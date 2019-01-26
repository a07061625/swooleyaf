<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 8:57
 */
namespace DingDing;

abstract class TalkBase extends DingBase {
    /**
     * 服务域名
     * @var string
     */
    protected $serviceDomain = '';

    public function __construct(){
        parent::__construct();
        $this->serviceDomain = 'https://oapi.dingtalk.com';
    }
}