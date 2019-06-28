<?php
require_once __DIR__ . '/helper_load.php';

$type = \Tool\Tool::getClientOption('-ct', false, '');
switch ($type) {
    case 'streams':
        $projects = include __DIR__ . '/helper_projects.php';
        \Helper\NginxTool::createStreamFile($projects);
        break;
    default:
        \Helper\NginxTool::help();
}
