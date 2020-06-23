<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:09
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class AccountMass
 * @package SyMessageHandler\Producers\Wx
 */
class AccountMass extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData)
    {
        // TODO: Implement checkMsgData() method.
    }
}
