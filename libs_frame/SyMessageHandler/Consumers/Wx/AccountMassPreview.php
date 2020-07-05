<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use Wx\Account\Message\MassPreview;

/**
 * Class AccountMassPreview
 * @package SyMessageHandler\Consumers\Wx
 */
class AccountMassPreview extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $massPreview = new MassPreview($msgData['app_id']);
        $massPreview->setMsgData($msgData['template_params']['type'], $msgData['template_params']['data']);
        if (strlen($msgData['receivers']['openid']) > 0) {
            $massPreview->setOpenid($msgData['receivers']['openid']);
        }
        if (strlen($msgData['receivers']['wx_name']) > 0) {
            $massPreview->setWxName($msgData['receivers']['wx_name']);
        }
        $sendRes = $massPreview->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
