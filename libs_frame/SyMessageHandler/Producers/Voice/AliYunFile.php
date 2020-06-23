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
use SyMessageHandler\ProducerInterface;

/**
 * Class AliYunFile
 * @package SyMessageHandler\Producers\Voice
 */
class AliYunFile extends ProducerBase implements ProducerInterface
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE);
    }
}
