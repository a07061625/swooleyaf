<?php
/**
 * 资源列举
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 10:10
 */
namespace QiNiu\Kodo\Object;

use QiNiu\QiNiuBaseKodo;
use QiNiu\QiNiuUtilBase;
use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

class FileListGet extends QiNiuBaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucket = '';
    /**
     * 位置标记
     * @var string
     */
    private $marker = '';
    /**
     * 条目数
     * @var int
     */
    private $limit = 0;
    /**
     * 前缀
     * @var string
     */
    private $prefix = '';
    /**
     * 目录分隔符
     * @var string
     */
    private $delimiter = '';

    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('rsf.qbox.me');
        $this->reqData = [
            'marker' => '',
            'limit' => 1000,
            'prefix' => '',
            'delimiter' => '',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucket
     * @throws \SyException\QiNiu\KodoException
     */
    public function setBucket(string $bucket)
    {
        if (ctype_alnum($bucket)) {
            $this->reqData['bucket'] = $bucket;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $marker
     * @throws \SyException\QiNiu\KodoException
     */
    public function setMarker(string $marker)
    {
        if (ctype_alnum($marker)) {
            $this->reqData['marker'] = $marker;
        } else {
            throw new KodoException('位置标记不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\QiNiu\KodoException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 1000)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new KodoException('条目数不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix)
    {
        $this->reqData['prefix'] = trim($prefix);
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter(string $delimiter)
    {
        $this->reqData['delimiter'] = trim($delimiter);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['bucket'])) {
            throw new KodoException('空间名称不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/list?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . QiNiuUtilBase::createAccessToken($this->serviceUri);
        return $this->getContent();
    }
}
