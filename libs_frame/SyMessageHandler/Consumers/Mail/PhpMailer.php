<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/25 0025
 * Time: 12:46
 */
namespace SyMessageHandler\Consumers\Mail;

use Mailer\SyPhpMailer;
use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;

/**
 * Class PhpMailer
 * @package SyMessageHandler\Consumers\Mail
 */
class PhpMailer extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_MAIL_PHP);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $mailer = new SyPhpMailer($msgData['ext_data']['node']);
        $mailer->setSenderNameAndEmail($msgData['senders']['email'], $msgData['senders']['name']);
        foreach ($msgData['receivers'] as $eReceiver) {
            $receiverName = $eReceiver['name'] ?? '';
            $mailer->addReceiver($eReceiver['email'], $receiverName);
        }
        $mailer->setTitle($msgData['template_params']['title']);
        $mailer->setBody($msgData['template_params']['body']);
        $mailer->setAltBody($msgData['template_params']['alt_body']);
        if (count($msgData['ext_data']['repliers']) > 0) {
            foreach ($msgData['ext_data']['repliers'] as $eReplier) {
                $replierName = $eReplier['name'] ?? '';
                $mailer->addReplier($eReplier['email'], $replierName);
            }
        }
        if (count($msgData['ext_data']['cc_list']) > 0) {
            foreach ($msgData['ext_data']['cc_list'] as $eCcInfo) {
                $ccName = $eCcInfo['name'] ?? '';
                $mailer->addCC($eCcInfo['email'], $ccName);
            }
        }
        if (count($msgData['ext_data']['bcc_list']) > 0) {
            foreach ($msgData['ext_data']['bcc_list'] as $eBccInfo) {
                $bccName = $eBccInfo['name'] ?? '';
                $mailer->addBCC($eBccInfo['email'], $bccName);
            }
        }
        if (count($msgData['template_params']['attachments']) > 0) {
            foreach ($msgData['template_params']['attachments'] as $eAttachment) {
                $mailer->addAttachment($eAttachment);
            }
        }
        $handleRes = $mailer->sendEmail();

        return $handleRes;
    }
}
