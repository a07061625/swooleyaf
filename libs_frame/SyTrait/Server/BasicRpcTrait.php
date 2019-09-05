<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 17:54
 */
namespace SyTrait\Server;

trait BasicRpcTrait
{
    private function checkServerRpc()
    {
        $this->checkServerBase();
        $this->checkServerRpcTrait();
    }

    private function initTableRpc()
    {
        $this->initTableBase();
        $this->initTableRpcTrait();
    }
}
