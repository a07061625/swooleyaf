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
 * 分片上传视频文件到文件服务器，该接口适用于西瓜
 *
 * @package SyDouYin\Video
 */
class PartUploadXiGua extends BaseVideo
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/xigua/video/part/upload/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $uploadId 分片上传标记
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

    /**
     * @param int $partNumber 分片位置
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setPartNumber(int $partNumber)
    {
        if ($partNumber > 0) {
            $this->reqData['part_number'] = $partNumber;
        } else {
            throw new DouYinVideoException('分片位置不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $partContent 分片上传内容
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setPartContent(string $partContent)
    {
        if (\strlen($partContent) > 0) {
            $this->reqData['video'] = $partContent;
        } else {
            throw new DouYinVideoException('分片上传内容不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
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
        if (!isset($this->reqData['part_number'])) {
            throw new DouYinVideoException('分片位置不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['video'])) {
            throw new DouYinVideoException('分片上传内容不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query([
            'open_id' => $this->reqData['open_id'],
            'access_token' => Util::getAccessToken([
                'client_key' => $this->clientKey,
                'host_type' => Util::SERVICE_HOST_TYPE_XIGUA,
                'open_id' => $this->reqData['open_id'],
            ]),
            'upload_id' => $this->reqData['upload_id'],
            'part_number' => $this->reqData['part_number'],
        ]);
        unset($this->reqData['open_id'], $this->reqData['upload_id'], $this->reqData['part_number']);
        $this->getContent();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: multipart/form-data',
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;

        return $this->curlConfigs;
    }
}
