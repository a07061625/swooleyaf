<?php
/**
 * 获取存储类型转换请求次数
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 10:29
 */
namespace SyObjectStorage\Kodo\Statistics;

use SyObjectStorage\BaseKodo;
use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;

class TypeChangeNumber extends BaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucket = '';
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
     * 存储区域
     * @var string
     */
    private $region = '';

    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('api.qiniu.com');
        $this->reqData = [
            'select' => 'hits',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucket
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setBucket(string $bucket)
    {
        if (ctype_alnum($bucket)) {
            $this->reqData['bucket'] = $bucket;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $begin
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setBeginTime(int $begin)
    {
        if ($begin > 1000000000) {
            $this->reqData['begin'] = date('YmdHis', $begin);
        } else {
            throw new KodoException('起始时间不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $end
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setEndTime(int $end)
    {
        if ($end > 1000000000) {
            $this->reqData['end'] = date('YmdHis', $end);
        } else {
            throw new KodoException('结束时间不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $timeSize
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setTimeSize(string $timeSize)
    {
        if (in_array($timeSize, ['5min', 'hour', 'day', 'month'])) {
            $this->reqData['g'] = $timeSize;
        } else {
            throw new KodoException('时间粒度不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $region
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setRegion(string $region)
    {
        if (isset(self::$totalRegionType[$region])) {
            $this->reqData['region'] = $region;
        } else {
            throw new KodoException('存储区域不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['begin'])) {
            throw new KodoException('起始时间不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['end'])) {
            throw new KodoException('结束时间不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['g'])) {
            throw new KodoException('时间粒度不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/v6/rs_chtype?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->serviceUri);
        return $this->getContent();
    }
}
