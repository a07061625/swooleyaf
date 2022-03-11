<?php
/**
 * 删除类目
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
 * 删除类目
 *
 * @package Wx\OpenMini
 */
class CategoryDelete extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 一级类目ID
     *
     * @var int
     */
    private $first = 0;
    /**
     * 二级类目ID
     *
     * @var int
     */
    private $second = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/wxopen/deletecategory?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
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

    public function getDetail(): array
    {
        if (!isset($this->reqData['first'])) {
            throw new WxOpenException('一级类目ID不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['second'])) {
            throw new WxOpenException('二级类目ID不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
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
