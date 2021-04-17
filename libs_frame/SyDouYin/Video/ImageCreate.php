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
 * 发布图片抖音（支持话题，小程序等功能）；该接口适用于抖音
 *
 * @package SyDouYin\Video
 */
class ImageCreate extends BaseVideo
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/image/create/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $imageId 图片ID
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setImageId(string $imageId)
    {
        if (\strlen($imageId) > 0) {
            $this->reqData['image_id'] = $imageId;
        } else {
            throw new DouYinVideoException('图片ID不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $text 图片标题
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setText(string $text)
    {
        if (\strlen($text) > 0) {
            $this->reqData['text'] = $text;
        } else {
            throw new DouYinVideoException('图片标题不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $poiId 地理位置id
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setPoiId(string $poiId)
    {
        if (\strlen($poiId) > 0) {
            $this->reqData['poi_id'] = $poiId;
        } else {
            throw new DouYinVideoException('地理位置id不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $poiName 地理位置名称
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setPoiName(string $poiName)
    {
        if (\strlen($poiName) > 0) {
            $this->reqData['poi_name'] = $poiName;
        } else {
            throw new DouYinVideoException('地理位置名称不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $microAppId 小程序id
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setMicroAppId(string $microAppId)
    {
        if (ctype_alnum($microAppId)) {
            $this->reqData['micro_app_id'] = $microAppId;
        } else {
            throw new DouYinVideoException('小程序id不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $microAppTitle 小程序标题
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setMicroAppTitle(string $microAppTitle)
    {
        if (\strlen($microAppTitle) > 0) {
            $this->reqData['micro_app_title'] = $microAppTitle;
        } else {
            throw new DouYinVideoException('小程序标题不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $microAppUrl 小程序页面地址
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setMicroAppUrl(string $microAppUrl)
    {
        if (\strlen($microAppUrl) > 0) {
            $this->reqData['micro_app_url'] = $microAppUrl;
        } else {
            throw new DouYinVideoException('小程序页面地址不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param array $atUsers 通知用户列表
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setAtUsers(array $atUsers)
    {
        $trueUsers = [];
        foreach ($atUsers as $eUser) {
            $openId = \is_string($eUser) ? trim($eUser) : '';
            if (\strlen($openId) > 0) {
                $trueUsers[$openId] = 1;
            }
        }
        if (empty($trueUsers)) {
            throw new DouYinVideoException('通知用户列表不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }

        $this->reqData['at_users'] = array_keys($trueUsers);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinVideoException('用户openid不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['image_id'])) {
            throw new DouYinVideoException('图片ID不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        if (!isset($this->reqData['text'])) {
            throw new DouYinVideoException('图片标题不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
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
