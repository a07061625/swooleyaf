<?php
/**
 * 为授权的小程序帐号上传小程序代码
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午9:19
 */
namespace Wx\OpenMini\Code;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class CodeUpload extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 代码模板ID
     * @var string
     */
    private $templateId = '';
    /**
     * 自定义代码版本号
     * @var string
     */
    private $userVersion = '';
    /**
     * 自定义代码描述
     * @var string
     */
    private $userDesc = '';

    /**
     * 自定义配置
     * @var array
     */
    private $extData = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/commit?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $templateId
     * @throws \SyException\Wx\WxOpenException
     */
    public function setTemplateId(string $templateId)
    {
        if (strlen($templateId) > 0) {
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new WxOpenException('代码模板ID不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param string $userVersion
     * @throws \SyException\Wx\WxOpenException
     */
    public function setUserVersion(string $userVersion)
    {
        if (strlen($userVersion) > 0) {
            $this->reqData['user_version'] = $userVersion;
        } else {
            throw new WxOpenException('自定义代码版本号不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param string $userDesc
     * @throws \SyException\Wx\WxOpenException
     */
    public function setUserDesc(string $userDesc)
    {
        if (strlen($userDesc) > 0) {
            $this->reqData['user_desc'] = $userDesc;
        } else {
            throw new WxOpenException('自定义代码描述不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param array $extData
     * @throws \SyException\Wx\WxOpenException
     */
    public function setExtData(array $extData)
    {
        if (empty($extData)) {
            throw new WxOpenException('自定义配置不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $this->extData = $extData;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['template_id'])) {
            throw new WxOpenException('模板ID不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (empty($this->extData)) {
            throw new WxOpenException('自定义配置不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        $this->reqData['ext_json'] = Tool::jsonEncode($this->extData, JSON_UNESCAPED_UNICODE);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
