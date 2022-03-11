<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 9:37
 */

namespace Wx\Account\Material;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class NewsUpdate extends WxBaseAccount
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 图文消息id
     *
     * @var string
     */
    private $media_id = '';
    /**
     * 文章位置
     *
     * @var int
     */
    private $index = 0;
    /**
     * 文章内容
     *
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
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMediaId(string $mediaId)
    {
        if (\strlen($mediaId) > 0) {
            $this->reqData['media_id'] = $mediaId;
        } else {
            throw new WxException('图文消息id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
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
     * @throws \SyException\Wx\WxException
     */
    public function setArticles(array $articles)
    {
        if (empty($articles)) {
            throw new WxException('文章内容不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['articles'] = $articles;
    }

    public function getDetail(): array
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

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
