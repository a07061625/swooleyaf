<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class LoggingConfig
 *
 * @package SyObjectStorage\Oss\Model
 *
 * @see http://help.aliyun.com/document_detail/oss/api-reference/bucket/PutBucketLogging.html
 */
class LoggingConfig implements XmlConfig
{
    private $targetBucket = '';
    private $targetPrefix = '';

    /**
     * LoggingConfig constructor.
     *
     * @param null $targetBucket
     * @param null $targetPrefix
     */
    public function __construct($targetBucket = null, $targetPrefix = null)
    {
        $this->targetBucket = $targetBucket;
        $this->targetPrefix = $targetPrefix;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * @param $strXml
     */
    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (!isset($xml->LoggingEnabled)) {
            return;
        }
        foreach ($xml->LoggingEnabled as $status) {
            foreach ($status as $key => $value) {
                if ('TargetBucket' === $key) {
                    $this->targetBucket = (string)$value;
                } elseif ('TargetPrefix' === $key) {
                    $this->targetPrefix = (string)$value;
                }
            }

            break;
        }
    }

    /**
     *  Serialize to xml string
     */
    public function serializeToXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><BucketLoggingStatus></BucketLoggingStatus>');
        if (isset($this->targetBucket, $this->targetPrefix)) {
            $loggingEnabled = $xml->addChild('LoggingEnabled');
            $loggingEnabled->addChild('TargetBucket', $this->targetBucket);
            $loggingEnabled->addChild('TargetPrefix', $this->targetPrefix);
        }

        return $xml->asXML();
    }

    /**
     * @return string
     */
    public function getTargetBucket()
    {
        return $this->targetBucket;
    }

    /**
     * @return string
     */
    public function getTargetPrefix()
    {
        return $this->targetPrefix;
    }
}
