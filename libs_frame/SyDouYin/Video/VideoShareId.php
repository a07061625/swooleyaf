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
 * 获取share_id；该接口适用于抖音
 *
 * @package SyDouYin\Video
 */
class VideoShareId extends BaseVideo
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/share-id/';
        $this->reqData = [
            'need_callback' => true,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param bool $needCallback 分享结果标识
     */
    public function isNeedCallback(bool $needCallback)
    {
        $this->reqData['need_callback'] = $needCallback;
    }

    /**
     * @param string $sourceStyleId 来源样式id
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setSourceStyleId(string $sourceStyleId)
    {
        if (\strlen($sourceStyleId) > 0) {
            $this->reqData['source_style_id'] = $sourceStyleId;
        } else {
            throw new DouYinVideoException('来源样式id不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $defaultHashTag 分享默认标识
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setDefaultHashTag(string $defaultHashTag)
    {
        if (\strlen($defaultHashTag) > 0) {
            $this->reqData['default_hashtag'] = $defaultHashTag;
        } else {
            throw new DouYinVideoException('分享默认标识不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $linkParam 来源url附加参数
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setLinkParam(string $linkParam)
    {
        if (\strlen($linkParam) > 0) {
            $this->reqData['link_param'] = $linkParam;
        } else {
            throw new DouYinVideoException('来源url附加参数不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        $this->reqData['access_token'] = Util::getClientToken($this->clientKey, $this->serviceHostType);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
