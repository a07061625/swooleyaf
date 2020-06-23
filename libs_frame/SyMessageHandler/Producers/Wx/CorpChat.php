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
use SyMessageHandler\ProducerInterface;

/**
 * Class CorpChat
 * @package SyMessageHandler\Producers\Wx
 */
class CorpChat extends ProducerBase implements ProducerInterface
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_CORP_CHAT);
    }
}
