<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Interface XmlConfig
 *
 * @package SyObjectStorage\Oss\Model
 */
interface XmlConfig
{
    /**
     * Interface method: Parse the object from the xml.
     *
     * @param string $strXml
     */
    public function parseFromXml($strXml);

    /**
     * Interface method: Serialize the object into xml.
     *
     * @return string
     */
    public function serializeToXml();
}
