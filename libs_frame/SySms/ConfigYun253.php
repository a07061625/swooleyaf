<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/8 0008
 * Time: 15:51
 */

namespace SySms;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Sms\Yun253Exception;
use SyTool\Tool;

class ConfigYun253
{
    /**
     * APP KEY
     *
     * @var string
     */
    private $appKey = '';
    /**
     * APP 密钥
     *
     * @var string
     */
    private $appSecret = '';
    /**
     * APP短信下发链接
     *
     * @var string
     */
    private $urlSmsSend = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __toString()
    {
        return Tool::jsonEncode($this->getConfigs(), JSON_UNESCAPED_UNICODE);
    }

    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * @throws \SyException\Sms\Yun253Exception
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new Yun253Exception('app key不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * @throws \SyException\Sms\Yun253Exception
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new Yun253Exception('app secret不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    public function getUrlSmsSend(): string
    {
        return $this->urlSmsSend;
    }

    /**
     * @throws \SyException\Sms\Yun253Exception
     */
    public function setUrlSmsSend(string $urlSmsSend)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $urlSmsSend) > 0) {
            $this->urlSmsSend = $urlSmsSend;
        } else {
            throw new Yun253Exception('短信下发链接不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * 获取配置数组
     */
    public function getConfigs(): array
    {
        return [
            'app.key' => $this->appKey,
            'app.secret' => $this->appSecret,
            'url.sms.send' => $this->urlSmsSend,
        ];
    }
}
