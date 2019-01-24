<?php
require_once __DIR__ . '/helper_load.php';

$projects = include(__DIR__ . '/helper_projects.php');
$commandPrefix = 'sudo /usr/local/php7/bin/php ' . __DIR__ . '/helper_service.php';
\Helper\ServiceManager::handleAllService($commandPrefix, $projects);