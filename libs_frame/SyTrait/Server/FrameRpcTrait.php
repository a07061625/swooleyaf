<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 16:54
 */
namespace SyTrait\Server;

trait FrameRpcTrait
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
