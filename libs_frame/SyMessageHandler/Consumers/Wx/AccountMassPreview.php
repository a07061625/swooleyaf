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
 * Class AccountMassPreview
 * @package SyMessageHandler\Consumers\Wx
 */
class AccountMassPreview extends ConsumerBase implements IConsumer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $handleRes['code'] = $sendRes['code'];
        if ($sendRes['code'] > 0) {
            $handleRes['msg'] = $sendRes['data'];
        } else {
            $handleRes['data'] = $sendRes['message'];
        }

        return $handleRes;
    }
}
