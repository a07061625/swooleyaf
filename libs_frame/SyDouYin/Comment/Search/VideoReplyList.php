<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Comment\Search;

use SyConstant\ErrorCode;
use SyDouYin\BaseComment;
use SyDouYin\Util;
use SyException\DouYin\DouYinCommentException;

/**
 * 评论回复列表
 *
 * @package SyDouYin\Comment\Search
 */
class VideoReplyList extends BaseComment
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/video/search/comment/reply/list/';
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
     * @throws \SyException\DouYin\DouYinCommentException
     */
    public function setCursor(int $cursor)
    {
        if ($cursor >= 0) {
            $this->reqData['cursor'] = $cursor;
        } else {
            throw new DouYinCommentException('分页游标不合法', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $count 每页数量
     * @throws \SyException\DouYin\DouYinCommentException
     */
    public function setCount(int $count)
    {
        if ($count > 0) {
            $this->reqData['count'] = $count;
        } else {
            throw new DouYinCommentException('每页数量不合法', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $secVideoId 加密视频id
     *
     * @throws \SyException\DouYin\DouYinCommentException
     */
    public function setSecVideoId(string $secVideoId)
    {
        if (\strlen($secVideoId) > 0) {
            $this->reqData['sec_item_id'] = $secVideoId;
        } else {
            throw new DouYinCommentException('加密视频id不合法', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $commentId 评论id
     *
     * @throws \SyException\DouYin\DouYinCommentException
     */
    public function setCommentId(string $commentId)
    {
        if (\strlen($commentId) > 0) {
            $this->reqData['comment_id'] = $commentId;
        } else {
            throw new DouYinCommentException('评论id不合法', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['sec_item_id'])) {
            throw new DouYinCommentException('加密视频id不能为空', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['comment_id'])) {
            throw new DouYinCommentException('评论id不能为空', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
        $this->reqData['access_token'] = Util::getClientToken($this->clientKey, $this->serviceHostType);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
