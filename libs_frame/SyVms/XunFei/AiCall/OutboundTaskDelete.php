<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/21 0021
 * Time: 15:33
 */
namespace SyVms\XunFei\AiCall;

use SyConstant\ErrorCode;
use SyException\Vms\XunFeiException;
use SyVms\BaseXunFeiAiCall;
use SyVms\UtilXunFei;

/**
 * 删除外呼任务
 *
 * @package SyVms\XunFei\AiCall
 */
class OutboundTaskDelete extends BaseXunFeiAiCall
{
    /**
     * 任务id
     *
     * @var string
     */
    private $task_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://callapi.xfyun.cn/v1/service/v1/aicall/outbound/v1/task/delete?token=';
        $this->reqData = [];
    }

    private function __clone()
    {
    }

    /**
     * @param string $taskId
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setTaskId(string $taskId)
    {
        if (ctype_alnum($taskId)) {
            $this->reqData['task_id'] = $taskId;
        } else {
            throw new XunFeiException('任务id不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['task_id'])) {
            throw new XunFeiException('任务id不能为空', ErrorCode::VMS_PARAM_ERROR);
        }

        $this->getContent();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . UtilXunFei::getAiCallToken();

        return $this->curlConfigs;
    }
}
