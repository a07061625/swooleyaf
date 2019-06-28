<?php
require_once __DIR__ . '/helper_load.php';

$type = \Tool\Tool::getClientOption('-ct', false, '');
switch ($type) {
    case 'streams':
        $configPath = \Tool\Tool::getClientOption('-path', false, '');
        if (!is_dir($configPath)) {
            exit('配置文件存放目录不合法' . PHP_EOL);
        }
        $logPath = \Tool\Tool::getClientOption('-logpath', false, '/home/logs/nginx');
        if (!is_dir($logPath)) {
            exit('日志文件存放目录不合法' . PHP_EOL);
        }
        $projects = include __DIR__ . '/helper_projects.php';
        \Helper\NginxTool::createStreamFile($projects, [
            'config_path' => $configPath,
            'log_path' => $logPath,
        ]);
        break;
    default:
        echo '用法: /usr/local/php7/bin/php helper_nginx.php 脚本参数' . PHP_EOL;
        echo '公共脚本参数:' . PHP_EOL;
        echo '    -h: 帮助' . PHP_EOL;
        echo '    -ct: 生成类型 streams:生成流配置文件' . PHP_EOL;
        echo '生成流配置脚本参数:' . PHP_EOL;
        echo '    -path: 配置文件存放目录,以/开头且不以/结尾' . PHP_EOL;
        echo '    -logpath: 日志文件存放目录,以/开头且不以/结尾,默认为/home/logs/nginx' . PHP_EOL;
}
