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
use SyDouYin\Util;
use SyException\DouYin\DouYinVideoException;

/**
 * 初始化分片上传获取upload_id。该接口适用于头条
 *
 * @package SyDouYin\Video
 */
class VideoPartInitTouTiao extends BaseVideo
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/toutiao/video/part/init/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $openId 用户openid
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setOpenId(string $openId)
    {
        if (\strlen($openId) > 0) {
            $this->reqData['open_id'] = $openId;
        } else {
            throw new DouYinVideoException('用户openid不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinVideoException('用户openid不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        $this->reqData['access_token'] = $this->getAccessToken($this->reqData['open_id'], Util::SERVICE_HOST_TYPE_TOUTIAO);
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
