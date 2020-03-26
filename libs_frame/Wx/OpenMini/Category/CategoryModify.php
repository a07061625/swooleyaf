<?php
/**
 * 修改类目
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
 * 修改类目
 * @package Wx\OpenMini
 */
class CategoryModify extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 一级类目ID
     * @var int
     */
    private $first = 0;
    /**
     * 二级类目ID
     * @var int
     */
    private $second = 0;
    /**
     * 类目信息列表
     * @var array
     */
    private $categories = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/wxopen/modifycategory?access_token=';
        $this->appId = $appId;
        $this->reqData['categories'] = [];
    }

    public function __clone()
    {
    }

    /**
     * @param int $first
     * @throws \SyException\Wx\WxOpenException
     */
    public function setFirst(int $first)
    {
        if ($first > 0) {
            $this->reqData['first'] = $first;
        } else {
            throw new WxOpenException('一级类目ID不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param int $second
     * @throws \SyException\Wx\WxOpenException
     */
    public function setSecond(int $second)
    {
        if ($second > 0) {
            $this->reqData['second'] = $second;
        } else {
            throw new WxOpenException('二级类目ID不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param array $categoryInfo
     * @throws \SyException\Wx\WxOpenException
     */
    public function addCategory(array $categoryInfo)
    {
        if (empty($categoryInfo)) {
            throw new WxOpenException('类目信息不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        $this->reqData['categories'][] = $categoryInfo;
    }

    public function getDetail() : array
    {
        if (isset($this->reqData['first'])) {
            throw new WxOpenException('一级类目ID不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (isset($this->reqData['second'])) {
            throw new WxOpenException('二级类目ID不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
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
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
