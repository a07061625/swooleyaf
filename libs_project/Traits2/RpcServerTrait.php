<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace Traits2;

use Response\Result;

trait RpcServerTrait {
    private function checkServerRpcTrait() {
    }

    private function initTableRpcTrait() {
    }

    protected function handleRpcTask(array $data) {
        $result = new Result();
        $result->setData([
            'result' => 'fail',
        ]);

        return $result->getJson();
    }
}