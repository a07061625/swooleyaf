<?php
/**
 * User: 姜伟
 * Date: 2018/12/30 0030
 * Time: 11:39
 */
namespace SyMessagePush\XinGe;

use SyConstant\ErrorCode;
use SyException\MessagePush\XinGePushException;
use SyMessagePush\PushBaseXinGe;

/**
 * 标签操作
 * @package SyMessagePush\XinGe
 */
class DeviceTag extends PushBaseXinGe
{
    /**
     * 操作类型
     * @var int
     */
    private $operator_type = 0;
    /**
     * 平台类型
     * @var string
     */
    private $platform = '';
    /**
     * 设备列表
     * @var array
     */
    private $token_list = [];
    /**
     * 标签列表
     * @var array
     */
    private $tag_list = [];
    /**
     * 标签设备对应列表
     * @var array
     */
    private $tag_token_list = [];
    /**
     * 请求ID
     * @var int
     */
    private $seq = 0;
    /**
     * 操作人员类型
     * @var string
     */
    private $op_type = '';
    /**
     * 接口操作人员id
     * @var string
     */
    private $op_id = '';

    public function __construct(string $platform)
    {
        parent::__construct($platform);
        $this->apiPath = 'device';
        $this->apiMethod = 'tag';
    }

    private function __clone()
    {
    }

    /**
     * @param int $operatorType
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setOperatorType(int $operatorType)
    {
        if (($operatorType > 0) && ($operatorType <= 10)) {
            $this->reqData['operator_type'] = $operatorType;
        } else {
            throw new XinGePushException('操作类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $platform
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setPlatform(string $platform)
    {
        if (in_array($platform, [self::PLATFORM_TYPE_IOS, self::PLATFORM_TYPE_ANDROID], true)) {
            $this->reqData['platform'] = $platform;
        } else {
            throw new XinGePushException('平台类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $tokenList
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setTokenList(array $tokenList)
    {
        if (empty($tokenList)) {
            throw new XinGePushException('设备列表不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['token_list'] = $tokenList;
    }

    /**
     * @param array $tagList
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setTagList(array $tagList)
    {
        if (empty($tagList)) {
            throw new XinGePushException('标签列表不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['tag_list'] = $tagList;
    }

    /**
     * @param array $tagTokenList
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setTagTokenList(array $tagTokenList)
    {
        if (empty($tagTokenList)) {
            throw new XinGePushException('标签设备对应列表不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['tag_token_list'] = $tagTokenList;
    }

    /**
     * @param int $seq
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setSeq(int $seq)
    {
        if ($seq > 0) {
            $this->reqData['seq'] = $seq;
        } else {
            throw new XinGePushException('请求ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $opType
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setOpType(string $opType)
    {
        if (in_array($opType, ['qq', 'rtx', 'email', 'other'], true)) {
            $this->reqData['op_type'] = $opType;
        } else {
            throw new XinGePushException('操作人员类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $opId
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setOpId(string $opId)
    {
        if (strlen($opId) > 0) {
            $this->reqData['op_id'] = $opId;
        } else {
            throw new XinGePushException('接口操作人员id不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['operator_type'])) {
            throw new XinGePushException('操作类型不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['platform'])) {
            throw new XinGePushException('平台类型不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['seq'])) {
            throw new XinGePushException('请求ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
