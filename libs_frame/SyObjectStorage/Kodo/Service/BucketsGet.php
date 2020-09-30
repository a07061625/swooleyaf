<?php
/**
 * 获取Bucket列表
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 9:24
 */
namespace SyObjectStorage\Kodo\Service;

use SyCloud\QiNiu\Util;
use SyObjectStorage\BaseKodo;

class BucketsGet extends BaseKodo
{
    /**
     * 过滤标签数组
     *
     * @var array
     */
    private $tags = [];

    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
        $this->setServiceHost('rs.qbox.me');
        $this->reqData['tagCondition'] = '';
    }

    private function __clone()
    {
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $tagStr = '';
        foreach ($tags as $tagKey => $tagVal) {
            $tagStr .= '&' . $tagKey . '=' . $tagVal;
        }

        if (strlen($tagStr) > 0) {
            $this->reqData['tagCondition'] = Util::safeBase64(substr($tagStr, 1));
        }
    }

    public function getDetail() : array
    {
        $this->serviceUri = '/buckets?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->accessKey, $this->serviceUri);

        return $this->getContent();
    }
}
