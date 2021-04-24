<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Image;

use SyConstant\ErrorCode;
use SyDouYin\BaseImage;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinImageException;

/**
 * 上传图片到文件服务器，得到图片的唯一标志image_id。该接口适用于抖音
 *
 * @package SyDouYin\Image
 */
class ImageUpload extends BaseImage
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/image/upload/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $image 上传图片文件
     *
     * @throws \SyException\DouYin\DouYinImageException
     */
    public function setImage(string $image)
    {
        if (!is_file($image)) {
            throw new DouYinImageException('上传图片文件不合法', ErrorCode::DOUYIN_IMAGE_PARAM_ERROR);
        }
        if (!is_readable($image)) {
            throw new DouYinImageException('上传图片文件不可读', ErrorCode::DOUYIN_IMAGE_PARAM_ERROR);
        }

        $file = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $file->file($image);
        if (!\is_string($mimeType)) {
            throw new DouYinImageException('获取上传图片文件类型失败', ErrorCode::DOUYIN_IMAGE_PARAM_ERROR);
        }
        if ('image/' != substr($mimeType, 0, 6)) {
            throw new DouYinImageException('上传图片文件类型不支持', ErrorCode::DOUYIN_IMAGE_PARAM_ERROR);
        }

        $this->reqData['image'] = new \CURLFile($image);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinImageException('用户openid不能为空', ErrorCode::DOUYIN_IMAGE_PARAM_ERROR);
        }
        if (!isset($this->reqData['image'])) {
            throw new DouYinImageException('上传图片文件不能为空', ErrorCode::DOUYIN_IMAGE_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query([
            'open_id' => $this->reqData['open_id'],
            'access_token' => Util::getAccessToken([
                'client_key' => $this->clientKey,
                'host_type' => $this->serviceHostType,
                'open_id' => $this->reqData['open_id'],
            ]),
        ]);
        unset($this->reqData['open_id']);
        $this->getContent();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: multipart/form-data',
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;

        return $this->curlConfigs;
    }
}
