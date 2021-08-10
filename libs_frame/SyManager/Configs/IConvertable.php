<?php

namespace SyManager\Configs;

/**
 * Class FileConverter
 *
 * @package SyManager\Configs
 */
interface IConvertable
{
    /**
     * Converts source config to target config format
     *
     * @return IConfigurable
     */
    public static function convert(IConfigurable $source, IConfigurable $target);

    /**
     * Converts source config to target config format and save it on target config file
     *
     * @return IConfigurable
     */
    public static function convertAndSave(IConfigurable $source, IConfigurable $target);
}
