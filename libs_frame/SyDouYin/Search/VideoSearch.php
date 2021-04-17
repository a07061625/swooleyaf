<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Search;

use SyConstant\ErrorCode;
use SyDouYin\BaseSearch;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinSearchException;

/**
 * 通过关键词搜索全站视频
 *
 * @package SyDouYin\Search
 */
class VideoSearch extends BaseSearch
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/video/search/';
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
     * @throws \SyException\DouYin\DouYinSearchException
     */
    public function setCursor(int $cursor)
    {
        if ($cursor >= 0) {
            $this->reqData['cursor'] = $cursor;
        } else {
            throw new DouYinSearchException('分页游标不合法', ErrorCode::DOUYIN_SEARCH_PARAM_ERROR);
        }
    }

    /**
     * @param int $count 每页数量
     *
     * @throws \SyException\DouYin\DouYinSearchException
     */
    public function setCount(int $count)
    {
        if ($count > 0) {
            $this->reqData['count'] = $count;
        } else {
            throw new DouYinSearchException('每页数量不合法', ErrorCode::DOUYIN_SEARCH_PARAM_ERROR);
        }
    }

    /**
     * @param string $keyword 关键词
     * @throws \SyException\DouYin\DouYinSearchException
     */
    public function setKeyword(string $keyword)
    {
        if (strlen($keyword) > 0) {
            $this->reqData['keyword'] = $keyword;
        } else {
            throw new DouYinSearchException('关键词不合法', ErrorCode::DOUYIN_SEARCH_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinSearchException('用户openid不能为空', ErrorCode::DOUYIN_SEARCH_PARAM_ERROR);
        }
        if (!isset($this->reqData['keyword'])) {
            throw new DouYinSearchException('关键词不能为空', ErrorCode::DOUYIN_SEARCH_PARAM_ERROR);
        }
        $this->reqData['access_token'] = Util::getAccessToken([
            'client_key' => $this->clientKey,
            'host_type' => $this->serviceHostType,
            'open_id' => $this->reqData['open_id'],
        ]);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
