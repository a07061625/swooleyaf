<?php
require_once __DIR__ . '/helper_load.php';

$type = \Tool\Tool::getClientOption('-st', false, 'server');
if ($type == 'server') {
    $projects = include __DIR__ . '/config_projects.php';
    $commandPrefix = 'sudo /usr/local/php7/bin/php ' . __DIR__ . '/helper_service.php';
    \Helper\ServiceManager::handleAllService($commandPrefix, $projects);
} elseif ($type == 'processpool') {
    $pools = include __DIR__ . '/helper_pools.php';
    $commandPrefix = 'sudo /usr/local/php7/bin/php ' . __DIR__ . '/helper_service.php';
    \Helper\ServiceManager::handleAllProcessPool($commandPrefix, $pools);
} else {
    exit('服务类型不支持' . PHP_EOL);
}
