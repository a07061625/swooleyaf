<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/9 0009
 * Time: 9:10
 */
namespace Helper;

use Tool\Tool;
use SyTrait\SimpleTrait;

class CodeTool
{
    use SimpleTrait;

    private static $totalMap = [
        'encrypt' => 'encryptFile',
        'decrypt' => 'decryptFile',
    ];

    private static function encryptFile(string $fileName, string $key)
    {
        $fileSize = filesize($fileName);
        if ($fileSize > 0) {
            $originContent = file_get_contents($fileName);
            $encryptFile = $fileName . '.txt';
            $encryptStr = Tool::encrypt($originContent, $key);
            file_put_contents($encryptFile, $encryptStr);

            $fp = fopen($fileName, 'rb+');
            $originContent = fread($fp, $fileSize);
            $data = tonyenc_encode($originContent);
            if (($data !== false) && (file_put_contents($fileName, '') !== false)) {
                rewind($fp);
                fwrite($fp, $data);
            }
            fclose($fp);
        }
    }

    private static function decryptFile(string $fileName, string $key)
    {
        $encryptFile = $fileName . '.txt';
        if (is_file($encryptFile)) {
            $encryptContent = file_get_contents($encryptFile);
            $decryptStr = Tool::decrypt($encryptContent, $key);
            file_put_contents($fileName, $decryptStr);
        }
    }

    public static function generator(string $fileName, string $key, string $type)
    {
        if (version_compare(PHP_VERSION, 7, '<')) {
            exit('PHP must later than version 7.0' . PHP_EOL);
        }
        if (php_sapi_name() !== 'cli') {
            exit('run mode must be cli' . PHP_EOL);
        }
        if (!extension_loaded('tonyenc')) {
            exit('tonyenc extension not loaded' . PHP_EOL);
        }

        $funcName = Tool::getArrayVal(self::$totalMap, $type, null);
        if (is_file($fileName)) {
            self::$funcName($fileName, $key);
        } elseif (is_dir($fileName)) {
            $directoryIterator = new \RecursiveDirectoryIterator($fileName, \FilesystemIterator::SKIP_DOTS);
            $allIterator = new \RecursiveIteratorIterator($directoryIterator);
            $it = new \RegexIterator($allIterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);
            foreach ($it as $v) {
                self::$funcName($v[0], $key);
            }
        } else {
            exit('Unknowing file: ' . $fileName . PHP_EOL);
        }
    }
}
