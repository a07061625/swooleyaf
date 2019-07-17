<?php
/**
 * 认证
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Auth;

use Constant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\IotBaseBaiDu;
use Tool\Tool;

class AuthenticatePassword extends IotBaseBaiDu
{
    /**
     * thing的用户名
     * @var string
     */
    private $username = '';
    /**
     * 身份密钥
     * @var string
     */
    private $password = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqMethod = self::REQ_METHOD_POST;
        $this->serviceUri = '/v1/auth/authenticate/password';
    }

    private function __clone()
    {
    }

    /**
     * @param string $userName
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setUserName(string $userName)
    {
        if (strlen($userName) > 0) {
            $this->reqData['username'] = $userName;
        } else {
            throw new BaiDuIotException('用户名不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $password
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPassword(string $password)
    {
        if (strlen($password) > 0) {
            $this->reqData['password'] = $password;
        } else {
            throw new BaiDuIotException('身份密钥不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['username'])) {
            throw new BaiDuIotException('用户名不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['password'])) {
            throw new BaiDuIotException('身份密钥不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->getContent();
    }
}
