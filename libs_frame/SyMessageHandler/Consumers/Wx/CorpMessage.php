<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Wx;

use SyConstant\Project;
use SyMessageHandler\ConsumerBase;
use SyMessageHandler\IConsumer;

/**
 * Class CorpMessage
 * @package SyMessageHandler\Consumers\Wx
 */
class CorpMessage extends ConsumerBase implements IConsumer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        return [];
    }
}
