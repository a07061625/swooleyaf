<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/7 0007
 * Time: 9:43
 */
namespace SySms;

use SyConstant\ErrorCode;
use SyException\Sms\AliYunException;
use SyTool\Tool;

class ConfigAliYun
{
    /**
     * 区域ID
     * @var string
     */
    private $regionId = '';
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

    /**
     * @return string
     */
    public function getRegionId() : string
    {
        return $this->regionId;
    }

    /**
     * @param string $regionId
     * @throws \SyException\Sms\AliYunException
     */
    public function setRegionId(string $regionId)
    {
        if (strlen($regionId) > 0) {
            $this->regionId = $regionId;
        } else {
            throw new AliYunException('区域ID不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppKey() : string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     * @throws \SyException\Sms\AliYunException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new AliYunException('app key不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppSecret() : string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     * @throws \SyException\Sms\AliYunException
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new AliYunException('app secret不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * 获取配置数组
     * @return array
     */
    public function getConfigs() : array
    {
        return [
            'region.id' => $this->regionId,
            'app.key' => $this->appKey,
            'app.secret' => $this->appSecret,
        ];
    }
}
