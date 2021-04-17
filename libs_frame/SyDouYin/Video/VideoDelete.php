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
 * 删除授权用户该抖音账号下的视频。该接口适用于抖音
 *
 * @package SyDouYin\Video
 */
class VideoDelete extends BaseVideo
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/video/delete/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $itemId 视频ID
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setVideoId(string $itemId)
    {
        if (\strlen($itemId) > 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new DouYinVideoException('视频ID不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinVideoException('用户openid不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['item_id'])) {
            throw new DouYinVideoException('视频ID不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
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
            'Content-Type: application/json',
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->curlConfigs;
    }
}
