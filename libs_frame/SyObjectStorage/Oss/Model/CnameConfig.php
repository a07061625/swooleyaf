<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class CnameConfig
 *
 * @package SyObjectStorage\Oss\Model
 *
 * TODO: fix link
 *
 * @see http://help.aliyun.com/document_detail/oss/api-reference/cors/PutBucketcors.html
 */
class CnameConfig implements XmlConfig
{
    const OSS_MAX_RULES = 10;

    private $cnameList = [];

    public function __construct()
    {
        $this->cnameList = [];
    }

    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * @return array
     *
     * @example
     *  array(2) {
     *    [0]=>
     *    array(3) {
     *      ["Domain"]=>
     *      string(11) "www.foo.com"
     *      ["Status"]=>
     *      string(7) "enabled"
     *      ["LastModified"]=>
     *      string(8) "20150101"
     *    }
     *    [1]=>
     *    array(3) {
     *      ["Domain"]=>
     *      string(7) "bar.com"
     *      ["Status"]=>
     *      string(8) "disabled"
     *      ["LastModified"]=>
     *      string(8) "20160101"
     *    }
     *  }
     */
    public function getCnames()
    {
        return $this->cnameList;
    }

    public function addCname($cname)
    {
        if (\count($this->cnameList) >= self::OSS_MAX_RULES) {
            throw new OssException(
                'num of cname in the config exceeds self::OSS_MAX_RULES: ' . (string)(self::OSS_MAX_RULES)
            );
        }
        $this->cnameList[] = ['Domain' => $cname];
    }

    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (!isset($xml->Cname)) {
            return;
        }
        foreach ($xml->Cname as $entry) {
            $cname = [];
            foreach ($entry as $key => $value) {
                $cname[(string)$key] = (string)$value;
            }
            $this->cnameList[] = $cname;
        }
    }

    public function serializeToXml()
    {
        $strXml = <<<'EOF'
<?xml version="1.0" encoding="utf-8"?>
<BucketCnameConfiguration>
</BucketCnameConfiguration>
EOF;
        $xml = new \SimpleXMLElement($strXml);
        foreach ($this->cnameList as $cname) {
            $node = $xml->addChild('Cname');
            foreach ($cname as $key => $value) {
                $node->addChild($key, $value);
            }
        }

        return $xml->asXML();
    }
}
