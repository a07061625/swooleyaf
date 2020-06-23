<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 21:27
 */
namespace SyMessageHandler;

use SyConstant\Project;
use SyMessageHandler\Producers\DingDing\Chat;
use SyMessageHandler\Producers\DingDing\Conversation;
use SyMessageHandler\Producers\DingDing\ConversationAsync;
use SyMessageHandler\Producers\Sms\AliYunBatch;
use SyMessageHandler\Producers\Sms\AliYunSingle;
use SyMessageHandler\Producers\Sms\DaYu;
use SyMessageHandler\Producers\Sms\Yun253;
use SyMessageHandler\Producers\Voice\AliYunFile;
use SyMessageHandler\Producers\Voice\AliYunTts;
use SyMessageHandler\Producers\Voice\QCloudCode;
use SyMessageHandler\Producers\Voice\QCloudTemplate;
use SyMessageHandler\Producers\Wx\AccountMass;
use SyMessageHandler\Producers\Wx\AccountMassAll;
use SyMessageHandler\Producers\Wx\AccountMassPreview;
use SyMessageHandler\Producers\Wx\AccountMessageCustom;
use SyMessageHandler\Producers\Wx\AccountTemplate;
use SyMessageHandler\Producers\Wx\AccountTemplateSubscribe;
use SyMessageHandler\Producers\Wx\CorpChat;
use SyMessageHandler\Producers\Wx\CorpMessage;
use SyMessageHandler\Producers\Wx\CorpMessageLinked;
use SyMessageHandler\Producers\Wx\MiniMessageCustom;
use SyMessageHandler\Producers\Wx\MiniTemplate;
use SyTool\BaseContainer;

/**
 * Class ProducerContainer
 * @package SyMessageHandler
 */
class ProducerContainer extends BaseContainer
{
    public function __construct()
    {
        $this->registryMap = [
            Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_ALL => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE_SUBSCRIBE => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_CORP_CHAT => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE_LINKED => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_MINI_MESSAGE_CUSTOM => 1,
            Project::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE => 1,
            Project::MESSAGE_HANDLER_TYPE_DINGDING_CHAT => 1,
            Project::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION => 1,
            Project::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC => 1,
            Project::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS => 1,
            Project::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE => 1,
            Project::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE => 1,
            Project::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE => 1,
            Project::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_SINGLE => 1,
            Project::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH => 1,
            Project::MESSAGE_HANDLER_TYPE_SMS_DAYU => 1,
            Project::MESSAGE_HANDLER_TYPE_SMS_YUN253 => 1,
        ];

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS, function(){
            return new AccountMass();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW, function(){
            return new AccountMassPreview();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_ALL, function(){
            return new AccountMassAll();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE, function(){
            return new AccountTemplate();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE_SUBSCRIBE, function(){
            return new AccountTemplateSubscribe();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM, function(){
            return new AccountMessageCustom();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_CORP_CHAT, function(){
            return new CorpChat();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE, function(){
            return new CorpMessage();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE_LINKED, function(){
            return new CorpMessageLinked();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_MINI_MESSAGE_CUSTOM, function(){
            return new MiniMessageCustom();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE, function(){
            return new MiniTemplate();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_DINGDING_CHAT, function(){
            return new Chat();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION, function(){
            return new Conversation();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC, function(){
            return new ConversationAsync();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS, function(){
            return new AliYunTts();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE, function(){
            return new AliYunFile();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE, function(){
            return new QCloudCode();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE, function(){
            return new QCloudTemplate();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_SINGLE, function(){
            return new AliYunSingle();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH, function(){
            return new AliYunBatch();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_SMS_DAYU, function(){
            return new DaYu();
        });

        $this->bind((string)Project::MESSAGE_HANDLER_TYPE_SMS_YUN253, function(){
            return new Yun253();
        });
    }
}
