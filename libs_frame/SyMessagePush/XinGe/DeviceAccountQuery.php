<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 15:35
 */
namespace SyMessagePush\XinGe;

use SyConstant\ErrorCode;
use SyException\MessagePush\XinGePushException;
use SyMessagePush\PushBaseXinGe;

/**
 * 账号-设备绑定查询
 * @package SyMessagePush\XinGe
 */
class DeviceAccountQuery extends PushBaseXinGe
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
     * 账号列表
     * @var array
     */
    private $account_list = [];
    /**
     * 设备列表
     * @var array
     */
    private $token_list = [];
    /**
     * 操作人员类型
     * @var string
     */
    private $op_type = '';
    /**
     * 操作人员id
     * @var string
     */
    private $op_id = '';

    public function __construct(string $platform)
    {
        parent::__construct($platform);
        $this->apiPath = 'device';
        $this->apiMethod = 'account/query';
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
        if (($operatorType > 0) && ($operatorType <= 2)) {
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
     * @param array $accountList
     * @throws \SyException\MessagePush\XinGePushException
     */
    public function setAccountList(array $accountList)
    {
        if (empty($accountList)) {
            throw new XinGePushException('账号列表不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['account_list'] = $accountList;
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

        return $this->getContent();
    }
}
