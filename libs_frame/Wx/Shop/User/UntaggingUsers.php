<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 15:12
 */
namespace Wx\Shop\User;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class UntaggingUsers extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 标签ID
     * @var int
     */
    private $tagid = 0;
    /**
     * 用户openid列表
     * @var array
     */
    private $openid_list = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param int $tagId
     * @throws \SyException\Wx\WxException
     */
    public function setTagId(int $tagId)
    {
        if ($tagId > 0) {
            $this->reqData['tagid'] = $tagId;
        } else {
            throw new WxException('标签ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $openidList
     */
    public function setOpenidList(array $openidList)
    {
        foreach ($openidList as $eOpenid) {
            if (is_string($eOpenid) && (strlen($eOpenid) == 28)) {
                $this->openid_list[$eOpenid] = 1;
            }
        }
    }

    /**
     * @param string $openid
     * @throws \SyException\Wx\WxException
     */
    public function addOpenid(string $openid)
    {
        if (strlen($openid) == 28) {
            $this->openid_list[$openid] = 1;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $num = count($this->openid_list);
        if ($num == 0) {
            throw new WxException('用户openid列表不能为空', ErrorCode::WX_PARAM_ERROR);
        } elseif ($num > 100) {
            throw new WxException('用户openid列表超过100个', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['tagid'])) {
            throw new WxException('标签ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['openid_list'] = array_keys($this->openid_list);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
