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
 * 发布视频到西瓜。该接口适用于西瓜
 *
 * @package SyDouYin\Video
 */
class VideoCreateXiGua extends BaseVideo
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/xigua/video/create/';
        $this->reqData = [
            'abstract' => '',
            'claim_origin' => false,
            'praise' => false,
        ];
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
        $textLength = mb_strlen($text);
        if ($textLength < 5) {
            throw new DouYinVideoException('视频标题不能小于5个字', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if ($textLength > 30) {
            throw new DouYinVideoException('视频标题不能超过30个字', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }

        $this->reqData['text'] = $text;
    }

    /**
     * @param string $abstract 视频简介
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setAbstract(string $abstract)
    {
        if (mb_strlen($abstract) <= 400) {
            $this->reqData['abstract'] = $abstract;
        } else {
            throw new DouYinVideoException('视频简介不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param bool $claimOrigin 原创标识
     */
    public function isClaimOrigin(bool $claimOrigin)
    {
        $this->reqData['claim_origin'] = $claimOrigin;
    }

    /**
     * @param int $coverTsp 视频封面帧时间点,单位为毫秒
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setCoverTsp(int $coverTsp)
    {
        if ($coverTsp > 0) {
            $this->reqData['cover_tsp'] = $coverTsp;
        } else {
            throw new DouYinVideoException('视频封面帧时间点不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param bool $praise 开通赞赏标识
     */
    public function isPraise(bool $praise)
    {
        $this->reqData['praise'] = $praise;
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
                'host_type' => Util::SERVICE_HOST_TYPE_XIGUA,
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
