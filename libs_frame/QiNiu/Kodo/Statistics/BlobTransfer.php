<?php
/**
 * 获取跨区域同步流量统计数据
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 10:29
 */
namespace QiNiu\Kodo\Statistics;

use QiNiu\QiNiuBaseKodo;
use QiNiu\QiNiuUtilBase;
use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

class BlobTransfer extends QiNiuBaseKodo
{
    /**
     * 起始时间戳
     * @var int
     */
    private $begin = 0;
    /**
     * 结束时间戳
     * @var int
     */
    private $end = 0;
    /**
     * 时间粒度
     * @var string
     */
    private $g = '';
    /**
     * 选择类型
     * @var string
     */
    private $select = '';
    /**
     * 海外同步标识 0:国内 1:海外
     * @var int
     */
    private $is_oversea = 0;
    /**
     * 任务ID
     * @var string
     */
    private $taskid = '';

    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('api.qiniu.com');
        $this->reqData = [
            'select' => 'size',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $begin
     * @throws \SyException\QiNiu\KodoException
     */
    public function setBeginTime(int $begin)
    {
        if ($begin > 1000000000) {
            $this->reqData['begin'] = date('YmdHis', $begin);
        } else {
            throw new KodoException('起始时间不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $end
     * @throws \SyException\QiNiu\KodoException
     */
    public function setEndTime(int $end)
    {
        if ($end > 1000000000) {
            $this->reqData['end'] = date('YmdHis', $end);
        } else {
            throw new KodoException('结束时间不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $timeSize
     * @throws \SyException\QiNiu\KodoException
     */
    public function setTimeSize(string $timeSize)
    {
        if (in_array($timeSize, ['5min', 'hour', 'day', 'month'])) {
            $this->reqData['g'] = $timeSize;
        } else {
            throw new KodoException('时间粒度不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $isOversea
     * @throws \SyException\QiNiu\KodoException
     */
    public function setIsOversea(int $isOversea)
    {
        if (in_array($isOversea, [0, 1])) {
            $this->reqData['is_oversea'] = $isOversea;
        } else {
            throw new KodoException('海外同步标识不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $taskId
     * @throws \SyException\QiNiu\KodoException
     */
    public function setTaskId(string $taskId)
    {
        if (strlen($taskId) > 0) {
            $this->reqData['taskid'] = $taskId;
        } else {
            throw new KodoException('任务ID不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['begin'])) {
            throw new KodoException('起始时间不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['end'])) {
            throw new KodoException('结束时间不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['g'])) {
            throw new KodoException('时间粒度不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/v6/blob_transfer?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . QiNiuUtilBase::createAccessToken($this->serviceUri);
        return $this->getContent();
    }
}
