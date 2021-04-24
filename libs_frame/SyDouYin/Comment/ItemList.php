<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Comment;

use SyConstant\ErrorCode;
use SyDouYin\BaseComment;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinCommentException;

/**
 * 用户获取评论列表
 *
 * @package SyDouYin\Comment
 */
class ItemList extends BaseComment
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/item/comment/list/';
        $this->reqData = [
            'cursor' => 0,
            'count' => 10,
            'sort_type' => 'time',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $cursor 分页游标
     *
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
     *
     * @throws \SyException\DouYin\DouYinCommentException
     */
    public function setCount(int $count)
    {
        if (($count > 0) && ($count <= 50)) {
            $this->reqData['count'] = $count;
        } else {
            throw new DouYinCommentException('每页数量不合法', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $itemId 视频id
     *
     * @throws \SyException\DouYin\DouYinCommentException
     */
    public function setItemId(string $itemId)
    {
        if (\strlen($itemId) > 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new DouYinCommentException('视频id不合法', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $sortType 排序方式
     *
     * @throws \SyException\DouYin\DouYinCommentException
     */
    public function setSortType(string $sortType)
    {
        if (\in_array($sortType, ['time', 'time_asc'])) {
            $this->reqData['sort_type'] = $sortType;
        } else {
            throw new DouYinCommentException('排序方式不合法', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinCommentException('用户openid不能为空', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['item_id'])) {
            throw new DouYinCommentException('视频id不能为空', ErrorCode::DOUYIN_COMMENT_PARAM_ERROR);
        }

        $this->reqData['access_token'] = Util::getAccessToken([
            'client_key' => $this->clientKey,
            'host_type' => Util::SERVICE_HOST_TYPE_DOUYIN,
            'open_id' => $this->reqData['open_id'],
        ]);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
