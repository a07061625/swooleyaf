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
 * Class MiniTemplate
 * @package SyMessageHandler\Consumers\Wx
 */
class MiniTemplate extends ConsumerBase implements IConsumer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
