<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:11
 */
namespace SyVms;

/**
 * Class VmsBaseQCloud
 * @package SyVms
 */
abstract class VmsBaseQCloud extends VmsBase
{
    /**
     * 服务地址
     * @var string
     */
    protected $serviceUrl = '';

    public function __construct()
    {
        parent::__construct();
    }
}
