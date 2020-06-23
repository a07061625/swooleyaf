<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Voice;

use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class QCloudCode
 * @package SyMessageHandler\Producers\Voice
 */
class QCloudCode extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData) : string
    {
        $checkRes = '';
        return $checkRes;
    }
}
