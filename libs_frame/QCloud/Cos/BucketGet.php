<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use SyConstant\ErrorCode;
use SyException\QCloud\CosException;
use QCloud\CloudBaseCos;

/**
 * 获取存储桶的对象列表
 * @package QCloud\Cos
 */
class BucketGet extends CloudBaseCos
{
    /**
     * 前缀
     * @var string
     */
    private $prefix = '';
    /**
     * 定界符
     * @var string
     */
    private $delimiter = '';
    /**
     * 编码方式
     * @var string
     */
    private $encoding_type = '';
    /**
     * 偏移量
     * @var int
     */
    private $offset = 0;
    /**
     * 条目数
     * @var int
     */
    private $limit = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
        $this->signParams['encoding-type'] = 'url';
        $this->reqData['encoding-type'] = 'url';
        $this->reqData['marker'] = 0;
        $this->reqData['max-keys'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @param string $prefix
     * @throws \SyException\QCloud\CosException
     */
    public function setPrefix(string $prefix)
    {
        if (strlen($prefix) > 0) {
            $this->reqData['prefix'] = $prefix;
        } else {
            throw new CosException('前缀不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $delimiter
     * @throws \SyException\QCloud\CosException
     */
    public function setDelimiter(string $delimiter)
    {
        if (strlen($delimiter) > 0) {
            $this->reqData['delimiter'] = $delimiter;
        } else {
            throw new CosException('定界符不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param int $offset
     * @throws \SyException\QCloud\CosException
     */
    public function setOffset(int $offset)
    {
        if ($offset > 0) {
            $this->reqData['marker'] = $offset;
        } else {
            throw new CosException('偏移量不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\QCloud\CosException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 1000)) {
            $this->reqData['max-keys'] = $limit;
        } else {
            throw new CosException('条目数不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $this->setReqQuery($this->reqData);
        return $this->getContent();
    }
}
