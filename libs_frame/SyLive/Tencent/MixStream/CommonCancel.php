<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 22:56
 */
namespace SyLive\Tencent\MixStream;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 取消通用混流
 *
 * @package SyLive\Tencent\MixStream
 */
class CommonCancel extends BaseTencent
{
    /**
     * 会话ID
     *
     * @var string
     */
    private $MixStreamSessionId = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CancelCommonMixStream';
    }

    private function __clone()
    {
    }

    /**
     * @param string $mixStreamSessionId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setMixStreamSessionId(string $mixStreamSessionId)
    {
        if (strlen($mixStreamSessionId) > 0) {
            $this->reqData['MixStreamSessionId'] = $mixStreamSessionId;
        } else {
            throw new TencentException('会话ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['MixStreamSessionId'])) {
            throw new TencentException('会话ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
