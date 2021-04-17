<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Video;

use SyConstant\ErrorCode;
use SyDouYin\BaseVideo;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinVideoException;

/**
 * 分片上传完成。该接口适用于抖音
 *
 * @package SyDouYin\Video
 */
class PartComplete extends BaseVideo
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/video/part/complete/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $uploadId 分片上传标记
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setUploadId(string $uploadId)
    {
        if (\strlen($uploadId) > 0) {
            $this->reqData['upload_id'] = $uploadId;
        } else {
            throw new DouYinVideoException('分片上传标记不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinVideoException('用户openid不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['upload_id'])) {
            throw new DouYinVideoException('分片上传标记不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        $this->reqData['access_token'] = Util::getAccessToken([
            'client_key' => $this->clientKey,
            'host_type' => Util::SERVICE_HOST_TYPE_DOUYIN,
            'open_id' => $this->reqData['open_id'],
        ]);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = '{}';

        return $this->curlConfigs;
    }
}
