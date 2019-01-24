<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/8 0008
 * Time: 15:51
 */
namespace SySms;

use Constant\ErrorCode;
use Exception\Sms\Yun253Exception;
use Tool\Tool;

class ConfigYun253 {
    /**
     * APP KEY
     * @var string
     */
    private $appKey = '';
    /**
     * APP 密钥
     * @var string
     */
    private $appSecret = '';
    /**
     * APP短信下发链接
     * @var string
     */
    private $urlSmsSend = '';

    public function __construct() {
    }

    private function __clone() {
    }

    /**
     * @return string
     */
    public function getAppKey() : string {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     * @throws \Exception\Sms\Yun253Exception
     */
    public function setAppKey(string $appKey) {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new Yun253Exception('app key不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppSecret() : string {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     * @throws \Exception\Sms\Yun253Exception
     */
    public function setAppSecret(string $appSecret) {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new Yun253Exception('app secret不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getUrlSmsSend() : string {
        return $this->urlSmsSend;
    }

    /**
     * @param string $urlSmsSend
     * @throws \Exception\Sms\Yun253Exception
     */
    public function setUrlSmsSend(string $urlSmsSend){
        if(preg_match('/^(http|https)\:\/\/\S+$/', $urlSmsSend) > 0){
            $this->urlSmsSend = $urlSmsSend;
        } else {
            throw new Yun253Exception('短信下发链接不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    public function __toString() {
        return Tool::jsonEncode($this->getConfigs(), JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取配置数组
     * @return array
     */
    public function getConfigs() : array {
        return [
            'app.key' => $this->appKey,
            'app.secret' => $this->appSecret,
            'url.sms.send' => $this->urlSmsSend,
        ];
    }
}