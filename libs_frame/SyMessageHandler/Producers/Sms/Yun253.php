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
use SyMessageHandler\ProducerInterface;

/**
 * Class Yun253
 * @package SyMessageHandler\Producers\Sms
 */
class Yun253 extends ProducerBase implements ProducerInterface
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_SMS_YUN253);
    }
}
