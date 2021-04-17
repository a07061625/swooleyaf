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
 * 查询poi信息
 *
 * @package SyDouYin\Video
 */
class PoiSearchKeyword extends BaseVideo
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/poi/search/keyword/';
        $this->reqData = [
            'cursor' => 0,
            'count' => 10,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $cursor 分页游标
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setCursor(int $cursor)
    {
        if ($cursor >= 0) {
            $this->reqData['cursor'] = $cursor;
        } else {
            throw new DouYinVideoException('分页游标不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param int $count 每页数量
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setCount(int $count)
    {
        if ($count > 0) {
            $this->reqData['count'] = $count;
        } else {
            throw new DouYinVideoException('每页数量不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $keyword 关键字
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setKeyword(string $keyword)
    {
        if (\strlen($keyword) > 0) {
            $this->reqData['keyword'] = $keyword;
        } else {
            throw new DouYinVideoException('关键字不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    /**
     * @param string $city 城市
     *
     * @throws \SyException\DouYin\DouYinVideoException
     */
    public function setCity(string $city)
    {
        if (\strlen($city) > 0) {
            $this->reqData['city'] = $city;
        } else {
            throw new DouYinVideoException('城市不合法', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['keyword'])) {
            throw new DouYinVideoException('关键字不能为空', ErrorCode::DOUYIN_VIDEO_PARAM_ERROR);
        }
        $this->reqData['access_token'] = Util::getClientToken($this->clientKey, $this->serviceHostType);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
