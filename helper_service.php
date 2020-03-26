<?php
require_once __DIR__ . '/helper_load.php';

$type = SyTool\Tool::getClientOption('-st', false, 'server');
if ($type == 'server') {
    \Helper\ServiceRunner::run(\SyConstant\Project::MODULE_NAME_API, \SyConstant\Project::$totalModuleName);
} elseif ($type == 'processpool') {
    \Helper\ServiceRunner::runProcessPool();
} else {
    exit('服务类型不支持' . PHP_EOL);
}
