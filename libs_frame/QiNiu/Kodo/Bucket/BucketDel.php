<?php
/**
 * 删除Bucket
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 11:30
 */
namespace QiNiu\Kodo\Bucket;

use QiNiu\QiNiuBaseKodo;
use QiNiu\QiNiuUtilBase;
use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

class BucketDel extends QiNiuBaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucketName = '';
    
    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('rs.qiniu.com');
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

    public function getDetail() : array
    {
        if (strlen($this->bucketName) == 0) {
            throw new KodoException('空间名称不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/drop/' . $this->bucketName;
        $this->reqHeader['Authorization'] = 'QBox ' . QiNiuUtilBase::createAccessToken($this->serviceUri);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = '';
        return $this->getContent();
    }
}
