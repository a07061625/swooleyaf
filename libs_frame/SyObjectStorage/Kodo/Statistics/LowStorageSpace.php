<?php
/**
 * 获取低频存储的存储量统计
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 10:29
 */
namespace SyObjectStorage\Kodo\Statistics;

use SyObjectStorage\BaseKodo;
use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;

class LowStorageSpace extends BaseKodo
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
     * 存储区域
     * @var string
     */
    private $region = '';
    /**
     * 提前删除标识 -1:显示所有 0:不显示提前删除的文件 1:只显示提前删除的文件
     * @var int
     */
    private $preDel = -1;

    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('api.qiniu.com');
        $this->reqData = [
            'g' => 'day',
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

    /**
     * @param int $preDel
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setPreDel(int $preDel)
    {
        if ($preDel == -1) {
            unset($this->reqData['no_predel']);
            unset($this->reqData['only_predel']);
        } elseif ($preDel == 0) {
            $this->reqData['no_predel'] = 1;
            unset($this->reqData['only_predel']);
        } elseif ($preDel == 1) {
            $this->reqData['only_predel'] = 1;
            unset($this->reqData['no_predel']);
        } else {
            throw new KodoException('提前删除标识不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
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

        $this->serviceUri = '/v6/space_line?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->serviceUri);
        return $this->getContent();
    }
}
