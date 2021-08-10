<?php

namespace SyManager\Configs;

/**
 * Class FileConverter
 *
 * @package SyManager\Configs
 */
class FileConverter implements IConvertable
{
    /**
     * {@inheritdoc}
     */
    public static function convert(IConfigurable $source, IConfigurable $target)
    {
        return $target->setConfig($source->getConfig());
    }

    /**
     * {@inheritdoc}
     */
    public static function convertAndSave(IConfigurable $source, IConfigurable $target)
    {
        $target->setConfig($source->getConfig());

        return $target->saveConfigFile();
    }
}
