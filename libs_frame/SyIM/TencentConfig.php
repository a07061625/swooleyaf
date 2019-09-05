<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/7 0007
 * Time: 16:04
 */
namespace SyIM;

use SyConstant\ErrorCode;
use SyException\IM\TencentException;

class TencentConfig
{
    /**
     * 应用id
     * @var string
     */
    private $appId = '';
    /**
     * 管理员帐号
     * @var string
     */
    private $accountAdmin = '';
    /**
     * 账号类型
     * @var string
     */
    private $accountType = '';
    /**
     * 私钥文件,全路径
     * @var string
     */
    private $privateKey = '';
    /**
     * 签名命令文件,全路径
     * @var string
     */
    private $commandSign = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getAppId() : string
    {
        return $this->appId;
    }

    /**
     * @param string $appId 应用ID
     * @throws \SyException\IM\TencentException
     */
    public function setAppId(string $appId)
    {
        if (ctype_alnum($appId)) {
            $this->appId = $appId;
        } else {
            throw new TencentException('appid不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAccountAdmin() : string
    {
        return $this->accountAdmin;
    }

    /**
     * @param string $accountAdmin
     * @throws \SyException\IM\TencentException
     */
    public function setAccountAdmin(string $accountAdmin)
    {
        if (ctype_alnum($accountAdmin)) {
            $this->accountAdmin = $accountAdmin;
        } else {
            throw new TencentException('管理员帐号不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAccountType() : string
    {
        return $this->accountType;
    }

    /**
     * @param string $accountType
     */
    public function setAccountType(string $accountType)
    {
        if (ctype_alnum($accountType)) {
            $this->accountType = $accountType;
        } else {
            throw new TencentException('账号类型不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPrivateKey() : string
    {
        return $this->privateKey;
    }

    /**
     * @param string $privateKey 私钥文件
     * @throws \SyException\IM\TencentException
     */
    public function setPrivateKey(string $privateKey)
    {
        if (!file_exists($privateKey)) {
            throw new TencentException('私钥文件必须存在', ErrorCode::IM_PARAM_ERROR);
        } elseif (!is_file($privateKey)) {
            throw new TencentException('私钥必须是文件', ErrorCode::IM_PARAM_ERROR);
        } elseif (!is_readable($privateKey)) {
            throw new TencentException('私钥文件必须可读', ErrorCode::IM_PARAM_ERROR);
        }

        $this->privateKey = $privateKey;
    }

    /**
     * @return string
     */
    public function getCommandSign() : string
    {
        return $this->commandSign;
    }

    /**
     * @param string $commandSign 签名命令文件
     * @throws \SyException\IM\TencentException
     */
    public function setCommandSign(string $commandSign)
    {
        if (!file_exists($commandSign)) {
            throw new TencentException('签名命令文件必须存在', ErrorCode::IM_PARAM_ERROR);
        } elseif (!is_file($commandSign)) {
            throw new TencentException('签名命令必须是文件', ErrorCode::IM_PARAM_ERROR);
        } elseif (!is_executable($commandSign)) {
            throw new TencentException('签名命令文件必须可执行', ErrorCode::IM_PARAM_ERROR);
        }

        $this->commandSign = $commandSign;
    }
}
