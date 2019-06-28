<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/28 0028
 * Time: 17:10
 */
namespace Helper;

use Tool\Tool;
use Traits\SimpleTrait;

class NginxTool
{
    use SimpleTrait;

    /**
     * 生产stream配置文件
     * @param array $projects
     * @param array $configs
     */
    public static function createStreamFile(array $projects, array $configs)
    {
        $tagLength = strlen(SY_PROJECT);
        $moduleConfigs = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.modules');
        foreach ($projects as $eProject) {
            $moduleTag = substr($eProject['module_name'], $tagLength);
            $fileName = $configs['config_path'] . '/' . $eProject['module_name'] . '.conf';
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
            $fileContent .= '    access_log ' . $configs['log_path']
                            . '/rpc' . $eProject['module_name']
                            . '.log rpc;' . PHP_EOL;
            $fileContent .= '    proxy_connect_timeout 1s;' . PHP_EOL;
            $fileContent .= '    proxy_timeout 30s;' . PHP_EOL;
            $fileContent .= '    proxy_buffer_size 32k;' . PHP_EOL;
            $fileContent .= '    proxy_next_upstream on;' . PHP_EOL;
            $fileContent .= '    proxy_pass rpc_a01api;' . PHP_EOL;
            $fileContent .= '}' . PHP_EOL;
            file_put_contents($fileName, $fileContent);
        }
    }
}
