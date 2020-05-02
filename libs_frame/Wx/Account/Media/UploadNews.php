<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 9:37
 */
namespace Wx\Account\Media;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class UploadNews extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 图文消息列表
     * @var array
     */
    private $articles = [];

    public function __construct(string $appId)
    {
        parent::__construct();

        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=';
        $this->appid = $appId;
        $this->reqData['articles'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @param array $articles
     * @throws \SyException\Wx\WxException
     */
    public function setArticles(array $articles)
    {
        $trueArticles = [];
        foreach ($articles as $eArticle) {
            if (is_array($eArticle) && (!empty($eArticle))) {
                $trueArticles[] = $eArticle;
            }
        }

        $articleNum = count($trueArticles);
        if ($articleNum == 0) {
            throw new WxException('图文消息不能为空', ErrorCode::WX_PARAM_ERROR);
        } elseif ($articleNum > 8) {
            throw new WxException('图文消息不能超过8个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['articles'] = $trueArticles;
    }

    /**
     * @param array $article
     * @throws \SyException\Wx\WxException
     */
    public function addArticle(array $article)
    {
        if (empty($article)) {
            throw new WxException('图文消息不能为空', ErrorCode::WX_PARAM_ERROR);
        } elseif (count($this->reqData['articles']) >= 8) {
            throw new WxException('图文消息不能超过8个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['articles'][] = $article;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData['articles'])) {
            throw new WxException('图文消息不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['media_id'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
