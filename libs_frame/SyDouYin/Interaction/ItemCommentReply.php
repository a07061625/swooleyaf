<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Interaction;

use SyConstant\ErrorCode;
use SyDouYin\BaseInteraction;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinInteractionException;
use SyTool\Tool;

/**
 * 用户回复视频评论
 *
 * @package SyDouYin\Interaction
 */
class ItemCommentReply extends BaseInteraction
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/item/comment/reply/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $commentId 评论id
     *
     * @throws \SyException\DouYin\DouYinInteractionException
     */
    public function setCommentId(string $commentId)
    {
        if (\strlen($commentId) > 0) {
            $this->reqData['comment_id'] = $commentId;
        } else {
            throw new DouYinInteractionException('评论id不合法', ErrorCode::DOUYIN_INTERACTION_PARAM_ERROR);
        }
    }

    /**
     * @param string $content 评论内容
     *
     * @throws \SyException\DouYin\DouYinInteractionException
     */
    public function setContent(string $content)
    {
        if (\strlen($content) > 0) {
            $this->reqData['content'] = $content;
        } else {
            throw new DouYinInteractionException('评论内容不合法', ErrorCode::DOUYIN_INTERACTION_PARAM_ERROR);
        }
    }

    /**
     * @param string $itemId 视频id
     *
     * @throws \SyException\DouYin\DouYinInteractionException
     */
    public function setItemId(string $itemId)
    {
        if (\strlen($itemId) > 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new DouYinInteractionException('视频id不合法', ErrorCode::DOUYIN_INTERACTION_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinInteractionException('用户openid不能为空', ErrorCode::DOUYIN_INTERACTION_PARAM_ERROR);
        }
        if (!isset($this->reqData['item_id'])) {
            throw new DouYinInteractionException('视频id不能为空', ErrorCode::DOUYIN_SEARCH_PARAM_ERROR);
        }
        if (!isset($this->reqData['content'])) {
            throw new DouYinInteractionException('评论内容不能为空', ErrorCode::DOUYIN_SEARCH_PARAM_ERROR);
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
