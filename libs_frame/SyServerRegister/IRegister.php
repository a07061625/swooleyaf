<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/18 0018
 * Time: 22:27
 */
namespace SyServerRegister;

/**
 * Class IRegister
 * @package SyServerRegister
 */
interface IRegister
{
    /**
     * 操作服务
     * @param string $action 操作类型 add:添加 remove:移除
     * @return array
     */
    public function operatorServer(string $action) : array;
}
