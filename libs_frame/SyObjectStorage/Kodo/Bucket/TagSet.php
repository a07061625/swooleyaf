<?php
/**
 * 设置空间标签
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 11:30
 */
namespace SyObjectStorage\Kodo\Bucket;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;
use SyTool\Tool;

class TagSet extends BaseKodo
{
    /**
     * 空间名称
     *
     * @var string
     */
    private $bucketName = '';
    /**
     * 标签列表
     *
     * @var array
     */
    private $tags = [];
    
    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
        $this->setServiceHost('uc.qbox.me');
        $this->reqHeader['Content-Type'] = 'application/json';
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucketName
     *
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
     * @param array $tags
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setTags(array $tags)
    {
        if (count($tags) > 10) {
            throw new KodoException('标签列表不能超过10个', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->tags = $tags;
    }

    public function getDetail() : array
    {
        if (strlen($this->bucketName) == 0) {
            throw new KodoException('空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->reqData['Tags'] = $this->tags;
        $this->serviceUri = '/bucketTagging?bucket=' . $this->bucketName;
        $this->reqHeader['Authorization'] = 'Qiniu ' . Util::createAccessToken($this->accessKey, $this->serviceUri);
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = 'PUT';
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
