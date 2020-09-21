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
 * 查询任务
 *
 * @package SyVms\XunFei\AiCall
 */
class OutboundTaskQuery extends BaseXunFeiAiCall
{
    /**
     * 任务id
     *
     * @var string
     */
    private $task_id = '';
    /**
     * 任务开始时间
     *
     * @var int
     */
    private $time_begin = 0;
    /**
     * 任务结束时间
     *
     * @var int
     */
    private $time_end = 0;
    /**
     * 任务名称
     *
     * @var string
     */
    private $task_name = '';
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 页码
     *
     * @var int
     */
    private $page_index = 0;
    /**
     * 排序字段
     *
     * @var string
     */
    private $sort_name = '';
    /**
     * 排序方式
     *
     * @var string
     */
    private $sort_order = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://callapi.xfyun.cn/v1/service/v1/aicall/outbound/v1/task/query?token=';
        $this->reqData = [
            'page_size' => 20,
            'page_index' => 1,
        ];
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
     * @param int $timeBegin 毫秒级开始时间
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setTimeBegin(int $timeBegin)
    {
        if ($timeBegin > 0) {
            $this->reqData['time_begin'] = $timeBegin;
        } else {
            throw new XunFeiException('任务开始时间不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param int $timeEnd 毫秒级结束时间
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setTimeEnd(int $timeEnd)
    {
        if ($timeEnd > 0) {
            $this->reqData['time_end'] = $timeEnd;
        } else {
            throw new XunFeiException('任务结束时间不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $taskName
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setTaskName(string $taskName)
    {
        if (strlen($taskName) > 0) {
            $this->reqData['task_name'] = $taskName;
        } else {
            throw new XunFeiException('任务名称不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 50)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new XunFeiException('每页记录数不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageIndex
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setPageIndex(int $pageIndex)
    {
        if ($pageIndex > 0) {
            $this->reqData['page_index'] = $pageIndex;
        } else {
            throw new XunFeiException('页码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $sortName
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setSortName(string $sortName)
    {
        if (strlen($sortName) > 0) {
            $this->reqData['sort_name'] = $sortName;
        } else {
            throw new XunFeiException('排序字段不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $sortOrder
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setSortOrder(string $sortOrder)
    {
        if (in_array($sortOrder, ['ASC', 'DESC'])) {
            $this->reqData['sort_order'] = $sortOrder;
        } else {
            throw new XunFeiException('排序方式不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $this->getContent();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . UtilXunFei::getAiCallToken();

        return $this->curlConfigs;
    }
}
