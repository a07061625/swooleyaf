<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-3-22
 * Time: 下午11:05
 */
namespace Traits;

trait ProcessPoolFrameTrait {
    private function checkPoolFrame() {
        if ($this->_configs['process']['num']['worker'] < 1) {
            exit('工作进程数量不能小于1' . PHP_EOL);
        }
        $numBacklog = $this->_configs['process']['num']['backlog'];
        if ($numBacklog < 1) {
            exit('监听队列长度不能小于1' . PHP_EOL);
        } else if (($numBacklog & ($numBacklog - 1)) != 0) {
            exit('监听队列长度必须是2的指数倍' . PHP_EOL);
        }
    }

    private function initTableFrame() {
    }
}