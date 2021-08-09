<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class RefererConfig
 *
 * @package SyObjectStorage\Oss\Model
 *
 * @see http://help.aliyun.com/document_detail/oss/api-reference/bucket/PutBucketReferer.html
 */
class RefererConfig implements XmlConfig
{
    private $allowEmptyReferer = true;
    private $refererList = [];

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * @param string $strXml
     */
    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (!isset($xml->AllowEmptyReferer)) {
            return;
        }
        if (!isset($xml->RefererList)) {
            return;
        }
        $this->allowEmptyReferer = 'TRUE' === (string)($xml->AllowEmptyReferer) || 'true' === (string)($xml->AllowEmptyReferer);

        foreach ($xml->RefererList->Referer as $key => $refer) {
            $this->refererList[] = (string)$refer;
        }
    }

    /**
     * serialize the RefererConfig object into xml string
     *
     * @return string
     */
    public function serializeToXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><RefererConfiguration></RefererConfiguration>');
        if ($this->allowEmptyReferer) {
            $xml->addChild('AllowEmptyReferer', 'true');
        } else {
            $xml->addChild('AllowEmptyReferer', 'false');
        }
        $refererList = $xml->addChild('RefererList');
        foreach ($this->refererList as $referer) {
            $refererList->addChild('Referer', $referer);
        }

        return $xml->asXML();
    }

    /**
     * @param bool $allowEmptyReferer
     */
    public function setAllowEmptyReferer($allowEmptyReferer)
    {
        $this->allowEmptyReferer = $allowEmptyReferer;
    }

    /**
     * @param string $referer
     */
    public function addReferer($referer)
    {
        $this->refererList[] = $referer;
    }

    /**
     * @return bool
     */
    public function isAllowEmptyReferer()
    {
        return $this->allowEmptyReferer;
    }

    /**
     * @return array
     */
    public function getRefererList()
    {
        return $this->refererList;
    }
}
