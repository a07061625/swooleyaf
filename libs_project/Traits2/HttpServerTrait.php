<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace Traits2;

use Constant\Project;
use Response\Result;
use Tool\Tool;

trait HttpServerTrait {
    private function checkServerHttpTrait() {
    }

    private function initTableHttpTrait() {
    }

    protected function handleHttpTask(array $data) {
        $resData = [
            'result' => 'success',
        ];
        $taskCommand = Tool::getArrayVal($data, 'task_command', '');
        switch ($taskCommand) {
            case Project::TASK_TYPE_CLEAR_API_SIGN_CACHE:
                $this->clearApiSign();
                break;
            default:
                $resData['result'] = 'fail';
                break;
        }

        $result = new Result();
        $result->setData($resData);
        return $result->getJson();
    }
}