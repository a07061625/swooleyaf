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
 * 提交任务数据
 *
 * @package SyVms\XunFei\AiCall
 */
class OutboundTaskInsert extends BaseXunFeiAiCall
{
    /**
     * 任务id
     *
     * @var string
     */
    private $task_id = '';
    /**
     * 数据列
     *
     * @var array
     */
    private $call_column = [];
    /**
     * 数据行
     *
     * @var array
     */
    private $call_list = [];

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://callapi.xfyun.cn/v1/service/v1/aicall/outbound/v1/task/insert?token=';
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

    /**
     * @param array $callColumn
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setCallColumn(array $callColumn)
    {
        $columns = [];
        foreach ($callColumn as $eColumn) {
            if (is_string($eColumn) && (strlen($eColumn) > 0)) {
                $columns[] = $eColumn;
            }
        }
        if (empty($columns)) {
            throw new XunFeiException('数据列不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        $this->reqData['call_column'] = $columns;
    }

    /**
     * @param array $callList
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setCallList(array $callList)
    {
        $num = count($callList);
        if ($num == 0) {
            throw new XunFeiException('数据行不能为空', ErrorCode::VMS_PARAM_ERROR);
        } elseif ($num > 50) {
            throw new XunFeiException('数据行不能超过50条', ErrorCode::VMS_PARAM_ERROR);
        }
        $this->reqData['call_list'] = $callList;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['task_id'])) {
            throw new XunFeiException('任务id不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['call_column'])) {
            throw new XunFeiException('数据列不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['call_list'])) {
            throw new XunFeiException('数据行不能为空', ErrorCode::VMS_PARAM_ERROR);
        }

        $this->getContent();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . UtilXunFei::getAiCallToken();

        return $this->curlConfigs;
    }
}
