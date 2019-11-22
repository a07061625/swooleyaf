<?php
/**
 * 获取Bucket列表
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 9:24
 */
namespace QiNiu\Kodo\Service;

use QiNiu\QiNiuBaseKodo;
use QiNiu\QiNiuUtilBase;

class BucketsGet extends QiNiuBaseKodo
{
    /**
     * 过滤标签数组
     * @var array
     */
    private $tags = [];

    public function __construct()
    {
        parent::__construct();
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
            $this->reqData['tagCondition'] = QiNiuUtilBase::safeBase64(substr($tagStr, 1));
        }
    }

    public function getDetail() : array
    {
        $this->serviceUri = '/buckets?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . QiNiuUtilBase::createAccessToken($this->serviceUri);
        $this->curlConfigs[CURLOPT_URL] = 'http://' . $this->serviceHost . $this->serviceUri;
        return $this->getContent();
    }
}
