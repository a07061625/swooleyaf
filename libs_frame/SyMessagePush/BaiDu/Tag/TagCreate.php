<?php
/**
 * 创建标签组
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 19:00
 */
namespace SyMessagePush\BaiDu\Tag;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;

class TagCreate extends PushBaseBaiDu
{
    /**
     * 标签名
     * @var string
     */
    private $tag = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/app/create_tag';
    }

    private function __clone()
    {
    }

    /**
     * @param string $tag
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setTag(string $tag)
    {
        if (ctype_alnum($tag)) {
            $this->reqData['tag'] = $tag;
        } else {
            throw new BaiDuPushException('标签名不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['tag'])) {
            throw new BaiDuPushException('标签名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
