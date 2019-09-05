<?php
require_once __DIR__ . '/helper_load.php';

$projects = include __DIR__ . '/config_projects.php';
$timeArr = explode('-', date('H-i'));
$minute = (int)$timeArr[1];
$hour = (int)$timeArr[0];

//定时检测数据库连接
if (in_array($minute, [0, 30], true)) {
    $dbCheck = new \Helper\DbCheck();
    $dbCheck->check($projects);
}

$container = new \SyTask\SyModuleTaskContainer();
$needMinute1 = $minute % 5;
$taskParams = [
    'task_minute' => $minute,
    'task_hour' => $hour,
];
foreach ($projects as $eProject) {
    $taskParams['projects'] = $eProject['listens'];
    $task = $container->getObj($eProject['module_name']);
    $task->handleTask($taskParams);
}
