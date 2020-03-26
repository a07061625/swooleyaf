<?php
/**
 * 获取可以用来设置的公众号列表
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 7:21
 */
namespace Wx\OpenMini\Base;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class ShowItemList extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 页数
     * @var int
     */
    private $page = 0;
    /**
     * 每页记录数
     * @var int
     */
    private $num = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/getwxamplinkforshow';
        $this->appId = $appId;
        $this->reqData['page'] = 0;
        $this->reqData['num'] = 10;
    }

    public function __clone()
    {
    }

    /**
     * @param int $page
     * @throws \SyException\Wx\WxOpenException
     */
    public function setPage(int $page)
    {
        if ($page >= 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new WxOpenException('页数不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param int $num
     * @throws \SyException\Wx\WxOpenException
     */
    public function setNum(int $num)
    {
        if (($num > 0) && ($num <= 20)) {
            $this->reqData['num'] = $num;
        } else {
            throw new WxOpenException('每页记录数不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->reqData['access_token'] = WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
