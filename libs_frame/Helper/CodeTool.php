<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/9 0009
 * Time: 9:10
 */
namespace Helper;

use SyTool\Tool;
use SyTrait\SimpleTrait;

class CodeTool
{
    use SimpleTrait;

    public static function generator(string $toolPath, string $type)
    {
        if (version_compare(PHP_VERSION, 7, '<')) {
            exit('PHP must later than version 7.0' . PHP_EOL);
        }
        if (php_sapi_name() !== 'cli') {
            exit('run mode must be cli' . PHP_EOL);
        }
        if (!extension_loaded('php_screw_plus')) {
            exit('php_screw_plus extension not loaded' . PHP_EOL);
        }

        $file = trim(Tool::getClientOption('-file', false, ''));
        if (strlen($file) == 0) {
            exit('加密文件或者文件目录为空' . PHP_EOL);
        } elseif ($file[0] != '/') {
            exit('加密文件或者文件目录必须以根目录/开始' . PHP_EOL);
        }

        $command = $toolPath . ' ' . $file;
        if ($type === 'decrypt') {
            $command .= ' -d';
        }
        $execRes = Tool::execSystemCommand($command);
        if ($execRes['code'] > 0) {
            system('echo -e "\e[1;31m ' . $execRes['msg'] . ' \e[0m"');
        } else {
            foreach ($execRes['data'] as $eResult) {
                system('echo -e "\e[1;32m ' . $eResult . ' \e[0m"');
            }
        }
    }
}
