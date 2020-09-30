<?php
/**
 * 获取外网流出流量统计和GET请求次数
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 10:29
 */
namespace SyObjectStorage\Kodo\Statistics;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;

class BlobIO extends BaseKodo
{
    /**
     * 空间名称
     *
     * @var string
     */
    private $bucket = '';
    /**
     * 起始时间戳
     *
     * @var int
     */
    private $begin = 0;
    /**
     * 结束时间戳
     *
     * @var int
     */
    private $end = 0;
    /**
     * 时间粒度
     *
     * @var string
     */
    private $g = '';
    /**
     * 选择类型
     *
     * @var string
     */
    private $select = '';
    /**
     * 存储区域
     *
     * @var string
     */
    private $region = '';
    /**
     * 存储类型 0:标准存储 1:低频存储
     *
     * @var int
     */
    private $ftype = 0;
    /**
     * 访问域名
     *
     * @var string
     */
    private $domain = '';
    /**
     * 请求来源
     *
     * @var string
     */
    private $src = '';

    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
        $this->setServiceHost('api.qiniu.com');
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucket
     *
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
     *
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
     *
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
     *
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
     * @param string $selectType
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setSelectType(string $selectType)
    {
        if (in_array($selectType, ['flow', 'hits'])) {
            $this->reqData['select'] = $selectType;
        } else {
            throw new KodoException('选择类型不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $region
     *
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
     * @param int $fileType
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setFileType(int $fileType)
    {
        if (in_array($fileType, [0, 1])) {
            $this->reqData['ftype'] = $fileType;
        } else {
            throw new KodoException('存储类型不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $domain
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setDomain(string $domain)
    {
        if (strlen($domain) > 0) {
            $this->reqData['domain'] = $domain;
        } else {
            throw new KodoException('访问域名不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $src
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setSrc(string $src)
    {
        if (in_array($src, ['origin', 'inner', 'ex', 'atlab'])) {
            $this->reqData['src'] = $src;
        } else {
            throw new KodoException('请求来源不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
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
        if (!isset($this->reqData['select'])) {
            throw new KodoException('选择类型不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/v6/blob_io?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->accessKey, $this->serviceUri);

        return $this->getContent();
    }
}
