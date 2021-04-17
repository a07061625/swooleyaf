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
use SyTool\Tool;

/**
 * 发布视频到头条。该接口适用于头条
 *
 * @package SyDouYin\Video
 */
class VideoCreateTouTiao extends BaseVideo
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/toutiao/video/create/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $videoId 视频ID
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setVideoId(string $videoId)
    {
        if (\strlen($videoId) > 0) {
            $this->reqData['video_id'] = $videoId;
        } else {
            throw new DouYinVideoException('视频ID不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $text 视频标题
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setText(string $text)
    {
        $textLength = \strlen($text);
        if (0 == $textLength) {
            throw new DouYinVideoException('视频标题不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if ($textLength > 30) {
            throw new DouYinVideoException('视频标题不能超过30个字符', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }

        $this->reqData['text'] = $text;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinVideoException('用户openid不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['video_id'])) {
            throw new DouYinVideoException('视频ID不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['text'])) {
            throw new DouYinVideoException('视频标题不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query([
            'open_id' => $this->reqData['open_id'],
            'access_token' => Util::getAccessToken([
                'client_key' => $this->clientKey,
                'host_type' => Util::SERVICE_HOST_TYPE_TOUTIAO,
                'open_id' => $this->reqData['open_id'],
            ]),
        ]);
        unset($this->reqData['open_id']);
        $this->getContent();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->curlConfigs;
    }
}
