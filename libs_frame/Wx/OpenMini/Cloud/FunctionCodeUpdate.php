<?php
/**
 * 上传云函数
 * User: 姜伟
 * Date: 18-9-13
 * Time: 上午12:17
 */
namespace Wx\OpenMini\Cloud;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class FunctionCodeUpdate extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 代码保护密钥
     * @var string
     */
    private $CodeSecret = '';
    /**
     * 函数处理方法名
     * @var string
     */
    private $Handler = '';
    /**
     * 函数名称
     * @var string
     */
    private $FunctionName = '';
    /**
     * 函数代码zip文件
     * @var string
     */
    private $ZipFile = '';
    /**
     * 命名空间
     * @var string
     */
    private $EnvId = '';
    /**
     * 自动安装依赖标识
     * @var string
     */
    private $InstallDependency = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://scf.tencentcloudapi.com';
        $this->appId = $appId;
        $this->reqData = [
            'Handler' => 'index.main',
            'InstallDependency' => 'FALSE',
        ];
    }

    public function __clone()
    {
    }

    public function setCodeSecret()
    {
        $this->reqData['CodeSecret'] = WxUtilOpenBase::getAuthorizerCodeSecret($this->appId);
    }

    /**
     * @param string $functionName
     * @throws \SyException\Wx\WxOpenException
     */
    public function setFunctionName(string $functionName)
    {
        if (ctype_alnum($functionName)) {
            $this->reqData['FunctionName'] = $functionName;
        } else {
            throw new WxOpenException('函数名称不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param string $zipFile
     * @throws \SyException\Wx\WxOpenException
     */
    public function setZipFile(string $zipFile)
    {
        if (is_file($zipFile) && is_readable($zipFile)) {
            $this->reqData['ZipFile'] = base64_encode(file_get_contents($zipFile));
        } else {
            throw new WxOpenException('函数代码zip文件不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param string $envId
     * @throws \SyException\Wx\WxOpenException
     */
    public function setEnvId(string $envId)
    {
        if (ctype_alnum($envId)) {
            $this->reqData['EnvId'] = $envId;
        } else {
            throw new WxOpenException('命名空间不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param string $installDependency
     * @throws \SyException\Wx\WxOpenException
     */
    public function setInstallDependency(string $installDependency)
    {
        if (in_array($installDependency, ['TRUE', 'FALSE'])) {
            $this->reqData['InstallDependency'] = $installDependency;
        } else {
            throw new WxOpenException('自动安装依赖标识不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['FunctionName'])) {
            throw new WxOpenException('函数名称不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        if (!isset($this->reqData['ZipFile'])) {
            throw new WxOpenException('函数代码zip文件不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        if (!isset($this->reqData['EnvId'])) {
            throw new WxOpenException('命名空间不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        $postData = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $hashedPayload = hash('sha256', $postData);
        $uploadSignatureGet = new UploadSignatureGet($this->appId);
        $uploadSignatureGet->setHashedPayload($hashedPayload);
        $signRes = $uploadSignatureGet->getDetail();
        if ($signRes['code'] > 0) {
            throw new WxOpenException($signRes['message'], $signRes['code']);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $postData;
        $this->curlConfigs[CURLOPT_HTTPHEADER] = explode('\r\n', $signRes['data']['headers']);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
