<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-11-14
 * Time: 下午7:05
 */
namespace SyTask;

interface SyModuleTaskInterface
{
    public function handleTask(array $data);
}
