<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:35
 */
namespace SyLive\Tencent\Record;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 终止录制任务
 *
 * @package SyLive\Tencent\Record
 */
class TaskStop extends BaseTencent
{
    /**
     * 任务ID
     *
     * @var string
     */
    private $TaskId = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'StopRecordTask';
    }

    private function __clone()
    {
    }

    /**
     * @param string $taskId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTaskId(string $taskId)
    {
        if (ctype_alnum($taskId)) {
            $this->reqData['TaskId'] = $taskId;
        } else {
            throw new TencentException('任务ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['TaskId'])) {
            throw new TencentException('任务ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
