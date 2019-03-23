<?php
require_once __DIR__ . '/helper_load.php';

$type = \Tool\Tool::getClientOption('-st', false, 'server');
if($type == 'server'){
    \Helper\ServiceRunner::run(\Constant\Project::MODULE_NAME_API, \Constant\Project::$totalModuleName);
} else if($type == 'processpool'){
    \Helper\ServiceRunner::runProcessPool();
} else {
    exit('服务类型不支持' . PHP_EOL);
}