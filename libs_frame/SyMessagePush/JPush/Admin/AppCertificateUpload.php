<?php
/**
 * app证书上传
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 19:47
 */
namespace SyMessagePush\JPush\Admin;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\AdminBase;
use SyMessagePush\PushUtilJPush;

class AppCertificateUpload extends AdminBase
{
    /**
     * 应用标识
     * @var string
     */
    private $app_key = '';
    /**
     * 测试环境证书文件
     * @var string
     */
    private $devCertificateFile = '';
    /**
     * 测试环境证书密码
     * @var string
     */
    private $devCertificatePassword = '';
    /**
     * 生产环境证书文件
     * @var string
     */
    private $proCertificateFile = '';
    /**
     * 生产环境证书密码
     * @var string
     */
    private $proCertificatePassword = '';

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'dev');
        $this->reqHeader['Content-Type'] = 'multipart/form-data';
    }

    private function __clone()
    {
    }

    /**
     * @param string $appKey
     * @throws \SyException\MessagePush\JPushException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->app_key = $appKey;
            $this->serviceUri = '/v1/app/' . $appKey . '/certificate';
        } else {
            throw new JPushException('应用标识不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $file
     * @param string $password
     * @throws \SyException\MessagePush\JPushException
     */
    public function setDevCert(string $file, string $password)
    {
        if (!is_file($file)) {
            throw new JPushException('测试环境证书不是文件', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        } elseif (!is_readable($file)) {
            throw new JPushException('测试环境证书不可读', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (strlen($password) == 0) {
            throw new JPushException('测试环境证书密码不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['devCertificateFile'] = '@' . $file;
        $this->reqData['devCertificatePassword'] = $password;
    }

    /**
     * @param string $file
     * @param string $password
     * @throws \SyException\MessagePush\JPushException
     */
    public function setProCert(string $file, string $password)
    {
        if (!is_file($file)) {
            throw new JPushException('生产环境证书不是文件', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        } elseif (!is_readable($file)) {
            throw new JPushException('生产环境证书不可读', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (strlen($password) == 0) {
            throw new JPushException('生产环境证书密码不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['proCertificateFile'] = '@' . $file;
        $this->reqData['proCertificatePassword'] = $password;
    }

    public function getDetail() : array
    {
        if (strlen($this->app_key) == 0) {
            throw new JPushException('应用标识不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if ((!isset($this->reqData['devCertificateFile'])) && !isset($this->reqData['proCertificateFile'])) {
            throw new JPushException('生产环境和测试环境证书不能同时为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = http_build_query($this->reqData);
        return $this->getContent();
    }
}
