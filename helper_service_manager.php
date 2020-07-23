<?php
require_once __DIR__ . '/helper_load.php';

$phpInfo = include __DIR__ . '/helper_php.php';
$type = \SyTool\Tool::getClientOption('-st', false, 'server');
if ($type == 'server') {
    $projects = include __DIR__ . '/config_projects.php';
    $commandPrefix = $phpInfo['dir_bin'] . ' ' . __DIR__ . '/helper_service.php';
    \Helper\ServiceManager::handleAllService($commandPrefix, $projects);
} elseif ($type == 'processpool') {
    $pools = include __DIR__ . '/config_pools.php';
    $commandPrefix = $phpInfo['dir_bin'] . ' ' . __DIR__ . '/helper_service.php';
    \Helper\ServiceManager::handleAllProcessPool($commandPrefix, $pools);
} else {
    exit('服务类型不支持' . PHP_EOL);
}
