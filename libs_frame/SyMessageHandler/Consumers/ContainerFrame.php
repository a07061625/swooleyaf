<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/25 0025
 * Time: 15:18
 */
namespace SyMessageHandler\Consumers;

use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\DingDing\Chat;
use SyMessageHandler\Consumers\DingDing\Conversation;
use SyMessageHandler\Consumers\DingDing\ConversationAsync;
use SyMessageHandler\Consumers\Mail\PhpMailer;
use SyMessageHandler\Consumers\Mail\SwiftMailer;
use SyMessageHandler\Consumers\Sms\AliYunBatch;
use SyMessageHandler\Consumers\Sms\AliYunSingle;
use SyMessageHandler\Consumers\Sms\DaYu;
use SyMessageHandler\Consumers\Sms\Yun253;
use SyMessageHandler\Consumers\Voice\AliYunFile;
use SyMessageHandler\Consumers\Voice\AliYunTts;
use SyMessageHandler\Consumers\Voice\QCloudCode;
use SyMessageHandler\Consumers\Voice\QCloudTemplate;
use SyMessageHandler\Consumers\Wx\AccountMass;
use SyMessageHandler\Consumers\Wx\AccountMassAll;
use SyMessageHandler\Consumers\Wx\AccountMassPreview;
use SyMessageHandler\Consumers\Wx\AccountMessageCustom;
use SyMessageHandler\Consumers\Wx\AccountTemplate;
use SyMessageHandler\Consumers\Wx\AccountTemplateSubscribe;
use SyMessageHandler\Consumers\Wx\CorpChat;
use SyMessageHandler\Consumers\Wx\CorpMessage;
use SyMessageHandler\Consumers\Wx\CorpMessageLinked;
use SyMessageHandler\Consumers\Wx\MiniMessageCustom;
use SyMessageHandler\Consumers\Wx\MiniTemplate;
use SyTool\BaseContainer;

/**
 * Class ContainerFrame
 * @package SyMessageHandler\Consumers
 */
class ContainerFrame extends BaseContainer
{
    public function __construct()
    {
        $this->registryMap = [
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_ALL => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE_SUBSCRIBE => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_CHAT => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE_LINKED => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_MINI_MESSAGE_CUSTOM => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CHAT => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_SINGLE => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_SMS_DAYU => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_SMS_YUN253 => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_MAIL_PHP => 1,
            ProjectBase::MESSAGE_HANDLER_TYPE_MAIL_SWIFT => 1,
        ];

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS, function(){
            return new AccountMass();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW, function(){
            return new AccountMassPreview();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_ALL, function(){
            return new AccountMassAll();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE, function(){
            return new AccountTemplate();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE_SUBSCRIBE, function(){
            return new AccountTemplateSubscribe();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM, function(){
            return new AccountMessageCustom();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_CHAT, function(){
            return new CorpChat();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE, function(){
            return new CorpMessage();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE_LINKED, function(){
            return new CorpMessageLinked();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_MINI_MESSAGE_CUSTOM, function(){
            return new MiniMessageCustom();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE, function(){
            return new MiniTemplate();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CHAT, function(){
            return new Chat();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION, function(){
            return new Conversation();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC, function(){
            return new ConversationAsync();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS, function(){
            return new AliYunTts();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE, function(){
            return new AliYunFile();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE, function(){
            return new QCloudCode();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE, function(){
            return new QCloudTemplate();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_SINGLE, function(){
            return new AliYunSingle();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH, function(){
            return new AliYunBatch();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_SMS_DAYU, function(){
            return new DaYu();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_SMS_YUN253, function(){
            return new Yun253();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_MAIL_PHP, function(){
            return new PhpMailer();
        });

        $this->bind((string)ProjectBase::MESSAGE_HANDLER_TYPE_MAIL_SWIFT, function(){
            return new SwiftMailer();
        });
    }
}
