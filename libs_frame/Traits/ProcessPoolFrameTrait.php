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
        if ($this->_configs['num']['backlog'] < 1024) {
            exit('监听队列长度不能小于1024' . PHP_EOL);
        }
    }

    private function initTableFrame() {
    }
}