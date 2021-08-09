<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class TaggingConfig
 *
 * @package SyObjectStorage\Oss\Model
 */
class TaggingConfig implements XmlConfig
{
    /**
     * Tag list
     *
     * @var Tag[]
     */
    private $tags = [];

    /**
     * TaggingConfig constructor.
     */
    public function __construct()
    {
        $this->tags = [];
    }

    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * Get Tag list
     *
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add a new Tag
     *
     * @param Tag $tag
     *
     * @throws OssException
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Parse TaggingConfig from the xml.
     *
     * @param string $strXml
     *
     * @throws OssException
     */
    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (!isset($xml->TagSet) || !isset($xml->TagSet->Tag)) {
            return;
        }
        foreach ($xml->TagSet->Tag as $tag) {
            $this->addTag(new Tag($tag->Key, $tag->Value));
        }
    }

    /**
     * Serialize the object into xml string.
     *
     * @return string
     */
    public function serializeToXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><Tagging></Tagging>');
        $xmlTagSet = $xml->addChild('TagSet');
        foreach ($this->tags as $tag) {
            $xmlTag = $xmlTagSet->addChild('Tag');
            $xmlTag->addChild('Key', (string)($tag->getKey()));
            $xmlTag->addChild('Value', (string)($tag->getValue()));
        }

        return $xml->asXML();
    }
}
