<?php
/**
 * 资源元信息修改
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 12:37
 */
namespace QiNiu\Kodo\Object;

use QiNiu\QiNiuBaseKodo;
use QiNiu\QiNiuUtilBase;
use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

class FileMetadataUpdate extends QiNiuBaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucketName = '';
    /**
     * 文件名称
     * @var string
     */
    private $fileName = '';
    /**
     * 文件Mime类型
     * @var string
     */
    private $mimeType = '';
    /**
     * 元数据数组
     * @var array
     */
    private $metaMap = [];
    /**
     * 更新条件数组
     * @var array
     */
    private $condMap = [];

    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('rs.qiniu.com');
        $this->reqHeader['Content-Type'] = 'application/x-www-form-urlencoded';
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucketName
     * @throws \SyException\QiNiu\KodoException
     */
    public function setBucketName(string $bucketName)
    {
        if (ctype_alnum($bucketName)) {
            $this->bucketName = $bucketName;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $fileName
     * @throws \SyException\QiNiu\KodoException
     */
    public function setFileName(string $fileName)
    {
        if (strlen($fileName) > 0) {
            $this->fileName = $fileName;
        } else {
            throw new KodoException('文件名称不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $mimeType
     * @throws \SyException\QiNiu\KodoException
     */
    public function setMimeType(string $mimeType)
    {
        if (strlen($mimeType) > 0) {
            $this->mimeType = QiNiuUtilBase::safeBase64($mimeType);
        } else {
            throw new KodoException('文件Mime类型不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param array $metaMap
     */
    public function setMetaMap(array $metaMap)
    {
        $this->metaMap = [];
        foreach ($metaMap as $metaKey => $metaVal) {
            if (!ctype_alnum($metaKey)) {
                continue;
            }
            if ((!is_string($metaVal)) && !is_numeric($metaVal)) {
                continue;
            }

            $keyLength = strlen($metaKey);
            if (($keyLength > 0) && ($keyLength <= 50)) {
                $this->metaMap[$metaKey] = QiNiuUtilBase::safeBase64($metaVal);
            }
        }
        $this->metaMap = $metaMap;
    }

    /**
     * @param array $condMap
     * @throws \SyException\QiNiu\KodoException
     */
    public function setCondMap(array $condMap)
    {
        if (empty($condMap)) {
            throw new KodoException('更新条件不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

        $this->condMap = $condMap;
    }

    public function getDetail() : array
    {
        if (strlen($this->bucketName) == 0) {
            throw new KodoException('空间名称不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (strlen($this->fileName) == 0) {
            throw new KodoException('文件名称不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (strlen($this->mimeType) == 0) {
            throw new KodoException('文件Mime类型不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (empty($this->metaMap)) {
            throw new KodoException('元数据不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (empty($this->condMap)) {
            throw new KodoException('更新条件不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

        $encodeUri = QiNiuUtilBase::encodeUri($this->bucketName, $this->fileName);
        $this->serviceUri = '/chgm/'.$encodeUri.'/mime/'.$this->mimeType;
        foreach ($this->metaMap as $metaKey => $metaVal) {
            $this->serviceUri .= '/x-qn-meta-' . $metaKey . '/' . $metaVal;
        }
        $this->serviceUri .= '/cond/';
        $condStr = '';
        foreach ($this->condMap as $condKey => $condVal) {
            $condStr .= '&' . $condKey . '=' . $condVal;
        }
        $this->serviceUri .= QiNiuUtilBase::safeBase64(substr($condStr, 1));
        $this->reqHeader['Authorization'] = 'QBox ' . QiNiuUtilBase::createAccessToken($this->serviceUri);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = '';
        return $this->getContent();
    }
}
