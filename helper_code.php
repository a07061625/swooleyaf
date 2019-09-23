<?php
/**
 * 代码处理
 * code: 12e8df4f68a600f6c1b11638_164952005f9fff2a8efeea3aa6e3d3c6_f68a600f6c1b1163
 * User: 姜伟
 * Date: 2019/7/9 0009
 * Time: 9:08
 */

require_once __DIR__ . '/helper_load.php';

function syhelp_code()
{
    echo '显示帮助: /usr/local/php7/bin/php helper_code.php -h' . PHP_EOL;
    echo '代码加密: /usr/local/php7/bin/php helper_code.php encrypt -file xxx.php -key xxx' . PHP_EOL;
    echo '    -file:必填 待加密文件或者文件目录,从根目录/开始' . PHP_EOL;
    echo '    -key:必填 密钥' . PHP_EOL;
    echo '代码解密: /usr/local/php7/bin/php helper_code.php decrypt -file xxx.php -key xxx' . PHP_EOL;
    echo '    -file:必填 待解密文件或者文件目录,从根目录/开始' . PHP_EOL;
    echo '    -key:必填 密钥' . PHP_EOL;
}

$option = \Tool\Tool::getClientOption(1, true);
switch ($option) {
    case 'encrypt':
        $file = trim(\Tool\Tool::getClientOption('-file', false, ''));
        if (strlen($file) == 0) {
            exit('加密文件或者文件目录为空' . PHP_EOL);
        } elseif ($file{0} != '/') {
            exit('加密文件或者文件目录必须以根目录/开始' . PHP_EOL);
        }
        $key = trim(\Tool\Tool::getClientOption('-key', false, ''));
        if (strlen($key) == 0) {
            exit('密钥为空' . PHP_EOL);
        }
        \Helper\CodeTool::generator($file, $key, 'encrypt');
        break;
    case 'decrypt':
        $file = trim(\Tool\Tool::getClientOption('-file', false, ''));
        if (strlen($file) == 0) {
            exit('解密文件或者文件目录为空' . PHP_EOL);
        } elseif ($file{0} != '/') {
            exit('解密文件或者文件目录必须以根目录/开始' . PHP_EOL);
        }
        $key = trim(\Tool\Tool::getClientOption('-key', false, ''));
        if (strlen($key) == 0) {
            exit('密钥为空' . PHP_EOL);
        }
        \Helper\CodeTool::generator($file, $key, 'decrypt');
        break;
    default:
        syhelp_code();
        break;
}
