<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 16:53
 */

namespace SyTrait\Server;

trait FrameHttpTrait
{
    private function checkServerHttp()
    {
        $this->checkServerBase();
        $this->checkServerHttpTrait();
    }

    private function initTableHttp()
    {
        $this->initTableBase();
        $this->initTableHttpTrait();
    }
}
