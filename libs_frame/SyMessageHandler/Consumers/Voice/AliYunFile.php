<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Voice;

use SyConstant\Project;
use SyMessageHandler\ConsumerBase;
use SyMessageHandler\IConsumer;

/**
 * Class AliYunFile
 * @package SyMessageHandler\Consumers\Voice
 */
class AliYunFile extends ConsumerBase implements IConsumer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        return [];
    }
}
