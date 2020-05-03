<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Merchant\Common;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchant;
use Wx\WxUtilBase;
use Wx\WxUtilMerchant;

class UploadImage extends WxBaseMerchant
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 图片名
     * @var string
     */
    private $image_name = '';
    /**
     * 图片内容
     * @var string
     */
    private $image_content = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/common/upload_img?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $imageName
     * @throws \SyException\Wx\WxException
     */
    public function setImageName(string $imageName)
    {
        if (strlen($imageName) > 0) {
            $this->image_name = $imageName;
        } else {
            throw new WxException('图片名不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $imageContent
     * @throws \SyException\Wx\WxException
     */
    public function setImageContent(string $imageContent)
    {
        if (strlen($imageContent) > 0) {
            $this->image_content = $imageContent;
        } else {
            throw new WxException('图片内容不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->image_name) == 0) {
            throw new WxException('图片名不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (strlen($this->image_content) == 0) {
            throw new WxException('图片内容不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilMerchant::getAccessToken($this->appid) . '&filename=' . urlencode($this->image_name);
        $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 3000;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->image_content;
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
