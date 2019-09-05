<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 9:37
 */
namespace Wx\Shop\Material;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class NewsUpdate extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 图文消息id
     * @var string
     */
    private $media_id = '';
    /**
     * 文章位置
     * @var int
     */
    private $index = 0;
    /**
     * 文章内容
     * @var array
     */
    private $articles = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/material/update_news?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $mediaId
     * @throws \SyException\Wx\WxException
     */
    public function setMediaId(string $mediaId)
    {
        if (strlen($mediaId) > 0) {
            $this->reqData['media_id'] = $mediaId;
        } else {
            throw new WxException('图文消息id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $index
     * @throws \SyException\Wx\WxException
     */
    public function setIndex(int $index)
    {
        if ($index >= 0) {
            $this->reqData['index'] = $index;
        } else {
            throw new WxException('文章位置不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $articles
     * @throws \SyException\Wx\WxException
     */
    public function setArticles(array $articles)
    {
        if (empty($articles)) {
            throw new WxException('文章内容不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['articles'] = $articles;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['media_id'])) {
            throw new WxException('图文消息id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['index'])) {
            throw new WxException('文章位置不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['articles'])) {
            throw new WxException('文章内容不能为空', ErrorCode::WX_PARAM_ERROR);
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
