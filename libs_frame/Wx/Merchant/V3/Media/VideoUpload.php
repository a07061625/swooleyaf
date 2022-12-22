<?php
/**
 * 视频上传
 * User: 姜伟
 * Date: 2022/12/22
 * Time: 11:04
 */

namespace Wx\Merchant\V3\Media;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class VideoUpload
 *
 * @package Wx\Merchant\V3\Media
 */
class VideoUpload extends WxBaseMerchantV3
{
    /**
     * 文件全路径,包括文件名
     *
     * @var string
     */
    private $file_path = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/merchant/media/video_upload';
        $this->reqMethod = self::REQUEST_METHOD_POST;
        array_push($this->curlConfigs[CURLOPT_HTTPHEADER], 'Content-Type: multipart/form-data');
        array_push($this->curlConfigs[CURLOPT_HTTPHEADER], 'Accept: application/json');
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $fileInfo = explode('/', $filePath);
            $this->reqData['file'] = new \CURLFile($filePath);
            $this->reqData['meta'] = [
                'filename' => array_pop($fileInfo),
                'sha256' => hash('sha256', file_get_contents($filePath)),
            ];
        } else {
            throw new WxException('文件不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (!isset($this->reqData['file'])) {
            throw new WxException('文件不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
