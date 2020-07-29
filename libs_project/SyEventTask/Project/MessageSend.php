<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/28 0028
 * Time: 21:52
 */
namespace SyEventTask\Project;

use DesignPatterns\Singletons\MessageHandlerSingleton;
use SyConstant\Project;
use SyConstant\SyInner;
use SyEventTask\TaskBase;
use SyLog\Log;

/**
 * Class MessageSend
 *
 * @package SyEventTask\Project
 */
class MessageSend extends TaskBase
{
    public function __construct()
    {
        parent::__construct();
        $this->supportServerTypes[SyInner::SERVER_TYPE_API_GATE] = 1;
        $this->intervalTime = 3000;
    }

    public function __clone()
    {
    }

    public function getData() : array
    {
        return [];
    }

    public function handle(array $data)
    {
        $msgNum = 1;
        while ($msgNum <= 200) {
            $msgNum++;

            try {
                $msgData = MessageHandlerSingleton::getInstance()->getMsgData(Project::MESSAGE_QUEUE_TYPE_RABBIT);
                if (empty($msgData)) {
                    break;
                }

                $res = MessageHandlerSingleton::getInstance()->invokeMsg($msgData);
                //保存处理结果到数据库等
            } catch (\Exception $e) {
                Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
            }
        }
    }
}
