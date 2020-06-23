<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Sms;

use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class AliYunBatch
 * @package SyMessageHandler\Producers\Sms
 */
class AliYunBatch extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData)
    {
        // TODO: Implement checkMsgData() method.
    }
}
