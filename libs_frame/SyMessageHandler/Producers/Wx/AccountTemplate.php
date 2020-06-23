<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class AccountTemplate
 * @package SyMessageHandler\Producers\Wx
 */
class AccountTemplate extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE);
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
