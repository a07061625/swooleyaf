<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/10 0010
 * Time: 17:58
 */
namespace SyPrint;

abstract class PrintBaseFeYin extends PrintBase
{
    /**
     * 服务域名
     * @var string
     */
    protected $serviceDomain = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceDomain = 'https://api.open.feyin.net';
    }
}
