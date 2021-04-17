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
 * 查询用户特定视频的数据, 如点赞数, 播放数等，返回的数据是实时的。该接口适用于抖音
 *
 * @package SyDouYin\Video
 */
class VideoData extends BaseVideo
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/video/data/';
    }

    private function __clone()
    {
    }

    /**
     * @param array $itemIds 视频ID列表
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setItemIds(array $itemIds)
    {
        $videoIdList = [];
        foreach ($itemIds as $eItemId) {
            $videoId = \is_string($eItemId) ? trim($eItemId) : '';
            if (\strlen($videoId) > 0) {
                $videoIdList[$videoId] = 1;
            }
        }
        if (empty($videoIdList)) {
            throw new DouYinVideoException('视频ID列表不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }

        $this->reqData['item_ids'] = array_keys($videoIdList);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinVideoException('用户openid不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['item_ids'])) {
            throw new DouYinVideoException('视频ID列表不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query([
            'open_id' => $this->reqData['open_id'],
            'access_token' => Util::getAccessToken([
                'client_key' => $this->clientKey,
                'host_type' => Util::SERVICE_HOST_TYPE_DOUYIN,
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
