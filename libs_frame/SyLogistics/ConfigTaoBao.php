<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/11 0011
 * Time: 11:27
 */
namespace SyLogistics;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyTool\Tool;

class ConfigTaoBao
{
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
    public function getAppKey() : string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new TaoBaoException('app key不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
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
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new TaoBaoException('app secret不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * 获取配置数组
     * @return array
     */
    public function getConfigs() : array
    {
        return [
            'app.key' => $this->appKey,
            'app.secret' => $this->appSecret,
        ];
    }
}
