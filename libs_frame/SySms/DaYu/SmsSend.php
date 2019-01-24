<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/7 0007
 * Time: 10:14
 */
namespace SySms\DaYu;

use Constant\ErrorCode;
use DesignPatterns\Singletons\SmsConfigSingleton;
use Exception\Sms\DaYuException;
use SySms\SmsBaseDaYu;
use Tool\Tool;

class SmsSend extends SmsBaseDaYu {
    /**
     * 短信类型
     * @var string
     */
    private $smsType = '';
    /**
     * 接收手机号码列表
     * @var array
     */
    private $recNumList = [];
    /**
     * 签名名称
     * @var string
     */
    private $signName = '';
    /**
     * 模板ID
     * @var string
     */
    private $templateCode = '';
    /**
     * 模板参数
     * @var array
     */
    private $smsParams = [];
    /**
     * @var array
     */
    private $badSmsSignNames = [];

    public function __construct() {
        parent::__construct();
        $this->appKey = SmsConfigSingleton::getInstance()->getDayuConfig()->getAppKey();
        $this->appSecret = SmsConfigSingleton::getInstance()->getDayuConfig()->getAppSecret();
        $this->reqData['sms_type'] = 'normal';
        $this->badSmsSignNames = [
            '大鱼测试',
            '活动验证',
            '变更验证',
            '登录验证',
            '注册验证',
            '身份验证',
        ];
        $this->setMethod('alibaba.aliqin.fc.sms.num.send');
    }

    private function __clone(){
    }

    /**
     * @param array $recNumList
     * @throws \Exception\Sms\DaYuException
     */
    public function setRecNumList(array $recNumList) {
        if(empty($recNumList)){
            throw new DaYuException('接收号码不能为空', ErrorCode::SMS_PARAM_ERROR);
        } else if(count($recNumList) > 200){
            throw new DaYuException('接收号码不能超过200个', ErrorCode::SMS_PARAM_ERROR);
        }

        foreach ($recNumList as $eRecNum) {
            if(ctype_digit($eRecNum) && (strlen($eRecNum) == 11) && ($eRecNum{0} == '1')){
                $this->recNumList[$eRecNum] = 1;
            } else {
                throw new DaYuException('接收号码不合法', ErrorCode::SMS_PARAM_ERROR);
            }
        }
    }

    /**
     * @param string $recNum
     * @throws \Exception\Sms\DaYuException
     */
    public function addRecNum(string $recNum){
        if(count($this->recNumList) >= 200){
            throw new DaYuException('接收号码不能超过200个', ErrorCode::SMS_PARAM_ERROR);
        }
        if(ctype_digit($recNum) && (strlen($recNum) == 11) && ($recNum{0} == '1')){
            $this->recNumList[$recNum] = 1;
        } else {
            throw new DaYuException('接收号码不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $signName
     * @throws \Exception\Sms\DaYuException
     */
    public function setSignName(string $signName) {
        if (strlen($signName) == 0) {
            throw new DaYuException('签名名称不能为空', ErrorCode::SMS_PARAM_ERROR);
        } else if (in_array($signName, $this->badSmsSignNames)) {
            throw new DaYuException('签名名称不能为系统默认签名', ErrorCode::SMS_PARAM_ERROR);
        }

        $this->reqData['sms_free_sign_name'] = $signName;
    }

    /**
     * @param string $templateId
     * @throws \Exception\Sms\DaYuException
     */
    public function setTemplateId(string $templateId) {
        if (strlen($templateId) > 0) {
            $this->reqData['sms_template_code'] = $templateId;
        } else {
            throw new DaYuException('模板ID不能为空', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @param array $params
     */
    public function setSmsParams(array $params) {
        if(!empty($params)){
            $this->reqData['sms_param'] = Tool::jsonEncode($params, JSON_UNESCAPED_UNICODE);
        }
    }

    public function getDetail() : array {
        if (empty($this->recNumList)) {
            throw new DaYuException('接收号码不能为空', ErrorCode::SMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['sms_free_sign_name'])) {
            throw new DaYuException('签名名称不能为空', ErrorCode::SMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['sms_template_code'])) {
            throw new DaYuException('模板ID不能为空', ErrorCode::SMS_PARAM_ERROR);
        }
        $this->reqData['rec_num'] = implode(',', array_keys($this->recNumList));

        return $this->getContent();
    }
}