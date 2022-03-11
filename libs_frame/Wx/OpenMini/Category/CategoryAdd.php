<?php
/**
 * 添加类目
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 7:21
 */

namespace Wx\OpenMini\Category;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

/**
 * 添加类目
 *
 * @package Wx\OpenMini
 */
class CategoryAdd extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 类目信息列表
     *
     * @var array
     */
    private $categories = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/wxopen/addcategory?access_token=';
        $this->appId = $appId;
        $this->reqData['categories'] = [];
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function addCategory(array $categoryInfo)
    {
        if (empty($categoryInfo)) {
            throw new WxOpenException('类目信息不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        $this->reqData['categories'][] = $categoryInfo;
    }

    public function getDetail(): array
    {
        if (empty($this->reqData['categories'])) {
            throw new WxOpenException('类目信息不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
