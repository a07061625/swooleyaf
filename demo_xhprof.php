<?php
require_once __DIR__ . '/helper_load.php';

\Tool\SyXhprof::start();
\Tool\Tool::createNonceStr(16);

$res = \Tool\SyXhprof::run('xhprof');

echo 'http://xhprof-ui-address/index.php?run=' . $res['run_id'] . '&source=' . $res['source'] . PHP_EOL;