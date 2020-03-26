<?php
require_once __DIR__ . '/helper_load.php';

SyTool\SyXhprof::start();
SyTool\Tool::createNonceStr(16);

$res = SyTool\SyXhprof::run('xhprof');

echo 'http://xhprof-ui-address/index.php?run=' . $res['run_id'] . '&source=' . $res['source'] . PHP_EOL;
