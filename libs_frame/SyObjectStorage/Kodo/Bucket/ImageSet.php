<?php
/**
 * 设置Bucket镜像源
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 9:53
 */
namespace SyObjectStorage\Kodo\Bucket;

use SyObjectStorage\BaseKodo;
use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;

class ImageSet extends BaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucketName = '';
    /**
     * 访问域名
     * @var string
     */
    private $srcSiteUrl = '';
    /**
     * 回源域名
     * @var string
     */
    private $host = '';

    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('pu.qbox.me');
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucketName
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setBucketName(string $bucketName)
    {
        if (ctype_alnum($bucketName)) {
            $this->bucketName = $bucketName;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $srcSiteUrl
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setSrcSiteUrl(string $srcSiteUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $srcSiteUrl) > 0) {
            $this->srcSiteUrl = Util::safeBase64($srcSiteUrl);
        } else {
            throw new KodoException('访问域名不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $host
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setHost(string $host)
    {
        if (strlen($host) > 0) {
            $this->host = Util::safeBase64($host);
        } else {
            throw new KodoException('回源域名不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->bucketName) == 0) {
            throw new KodoException('空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (strlen($this->srcSiteUrl) == 0) {
            throw new KodoException('访问域名不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/image/' . $this->bucketName . '/from/' . $this->srcSiteUrl . '/host/' . $this->host;
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->serviceUri);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = '';
        return $this->getContent();
    }
}
