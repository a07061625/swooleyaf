<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */
namespace Wx\Shop\Message;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class MassDelete extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 消息ID
     * @var string
     */
    private $msg_id = '';
    /**
     * 消息索引
     * @var int
     */
    private $article_idx = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token=';
        $this->appid = $appId;
        $this->reqData['article_idx'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $msgId
     * @throws \SyException\Wx\WxException
     */
    public function setMsgId(string $msgId)
    {
        if (ctype_digit($msgId)) {
            $this->reqData['msg_id'] = $msgId;
        } else {
            throw new WxException('消息ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $articleIdx
     * @throws \SyException\Wx\WxException
     */
    public function setArticleIdx(int $articleIdx)
    {
        if ($articleIdx < 0) {
            $this->reqData['article_idx'] = $articleIdx;
        } else {
            throw new WxException('消息索引不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['msg_id'])) {
            throw new WxException('消息ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

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
