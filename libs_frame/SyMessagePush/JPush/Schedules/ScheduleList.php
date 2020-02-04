<?php
/**
 * 获取有效的定时任务列表
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 15:18
 */
namespace SyMessagePush\JPush\Schedules;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\SchedulesBase;
use SyMessagePush\PushUtilJPush;

class ScheduleList extends SchedulesBase
{
    /**
     * 页数
     * @var int
     */
    private $page = 0;

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
        $this->serviceUri = '/v3/schedules';
        $this->reqData['page'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param int $page
     * @throws \SyException\MessagePush\JPushException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new JPushException('页数不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $url = $this->serviceDomain . $this->serviceUri . '?' . http_build_query($this->reqData);
        $this->curlConfigs[CURLOPT_URL] = $url;
        return $this->getContent();
    }
}
