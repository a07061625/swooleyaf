<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 18:00
 */
namespace Wx\Mini;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilBase;
use Wx\WxUtilAlone;
use Wx\WxUtilOpenBase;

class MsgTemplateTitleKeywords extends WxBaseMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 模板标题id
     * @var string
     */
    private $titleId = '';
    /**
     * 平台类型
     * @var string
     */
    private $platType = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/wxopen/template/library/get?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $titleId
     * @throws \SyException\Wx\WxException
     */
    public function setTitleId(string $titleId)
    {
        if (strlen($titleId) > 0) {
            $this->reqData['id'] = $titleId;
        } else {
            throw new WxException('模板标题id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $platType
     * @throws \SyException\Wx\WxException
     */
    public function setPlatType(string $platType)
    {
        if (in_array($platType, [WxUtilBase::PLAT_TYPE_MINI, WxUtilBase::PLAT_TYPE_OPEN_MINI], true)) {
            $this->platType = $platType;
        } else {
            throw new WxException('平台类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['id'])) {
            throw new WxException('模板标题id不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        if ($this->platType == WxUtilBase::PLAT_TYPE_MINI) {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appId);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['id'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
