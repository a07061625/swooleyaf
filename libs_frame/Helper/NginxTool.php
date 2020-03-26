<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/28 0028
 * Time: 17:10
 */
namespace Helper;

use SyTool\Tool;
use SyTrait\SimpleTrait;

class NginxTool
{
    use SimpleTrait;

    /**
     * 生产流配置文件
     * @param array $projects
     */
    public static function createStreamFile(array $projects)
    {
        $configPath = Tool::getClientOption('-path', false, '');
        if (!is_dir($configPath)) {
            exit('配置文件存放目录不合法' . PHP_EOL);
        }
        $logPath = Tool::getClientOption('-logpath', false, '');
        if ((strlen($logPath) > 0) && (!is_dir($logPath))) {
            exit('日志文件存放目录不合法' . PHP_EOL);
        }
        $tagLength = strlen(SY_PROJECT);
        $moduleConfigs = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.modules');
        foreach ($projects as $eProject) {
            $moduleTag = substr($eProject['module_name'], $tagLength);
            $fileName = $configPath . '/' . $eProject['module_name'] . '.conf';
            $fileContent = 'upstream rpc_' . $eProject['module_name'] . ' {' . PHP_EOL;
            $fileContent .= '    zone rpc_' . $eProject['module_name'] . ' 64k;' . PHP_EOL;
            $fileContent .= '    least_conn;' . PHP_EOL;
            foreach ($eProject['listens'] as $eListen) {
                $fileContent .= '    server ' . $eListen['host']
                                . ':' . $eListen['port']
                                . ' weight=1 max_fails=3 fail_timeout=30s;' . PHP_EOL;
            }
            $fileContent .= '}' . PHP_EOL;
            $fileContent .= 'server {' . PHP_EOL;
            $fileContent .= '    listen ' . $moduleConfigs[$moduleTag]['host']
                            . ':' . $moduleConfigs[$moduleTag]['port']
                            . ' so_keepalive=60s::;' . PHP_EOL;
            $fileContent .= '    tcp_nodelay on;' . PHP_EOL;
            if (strlen($logPath) > 0) {
                $fileContent .= '    access_log ' . $logPath
                                . '/rpc' . $eProject['module_name']
                                . '.log rpc;' . PHP_EOL;
            }
            $fileContent .= '    proxy_connect_timeout 1s;' . PHP_EOL;
            $fileContent .= '    proxy_timeout 30s;' . PHP_EOL;
            $fileContent .= '    proxy_buffer_size 32k;' . PHP_EOL;
            $fileContent .= '    proxy_next_upstream on;' . PHP_EOL;
            $fileContent .= '    proxy_pass rpc_' . $eProject['module_name'] . ';' . PHP_EOL;
            $fileContent .= '}' . PHP_EOL;
            file_put_contents($fileName, $fileContent);
        }
    }

    public static function help()
    {
        echo '用法: /usr/local/php7/bin/php helper_nginx.php 脚本参数' . PHP_EOL;
        echo '公共脚本参数:' . PHP_EOL;
        echo '    -h: 帮助' . PHP_EOL;
        echo '    -ct: 生成类型 streams:生成流配置文件' . PHP_EOL;
        echo '生成流配置脚本参数:' . PHP_EOL;
        echo '    -path: 配置文件存放目录,以/开头且不以/结尾' . PHP_EOL;
        echo '    -logpath: 日志文件存放目录,以/开头且不以/结尾,默认为/home/logs/nginx' . PHP_EOL;
    }
}
