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

class UploadVideo extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 媒体ID
     * @var string
     */
    private $media_id = '';
    /**
     * 视频标题
     * @var string
     */
    private $title = '';
    /**
     * 视频描述
     * @var string
     */
    private $description = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=';
        $this->appid = $appId;
        $this->reqData['description'] = '';
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
            throw new WxException('媒体ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $title
     * @throws \SyException\Wx\WxException
     */
    public function setTitle(string $title)
    {
        if (strlen($title) > 0) {
            $this->reqData['title'] = $title;
        } else {
            throw new WxException('视频标题不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->reqData['description'] = $description;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['media_id'])) {
            throw new WxException('媒体ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['title'])) {
            throw new WxException('视频标题不能为空', ErrorCode::WX_PARAM_ERROR);
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
