<?php
define('SY_ROOT', __DIR__);
define('SY_ENV', 'dev');
define('SY_PROJECT', 'z01');
define('SY_DATABASE', true);
define('SY_LC_WX_ACCOUNT', false);
define('SY_LC_WXOPEN_AUTHORIZER', false);
define('SY_PROJECT_LIBS_ROOT', __DIR__ . '/libs_project/');
define('SY_TOKEN', '245dcbf2');

$frameLibsDir = \Yaconf::get('project.' . SY_ENV . SY_PROJECT . '.dir.libs.frame');
if (substr($frameLibsDir, -1) == '/') {
    define('SY_FRAME_LIBS_ROOT', $frameLibsDir);
} else {
    define('SY_FRAME_LIBS_ROOT', $frameLibsDir . '/');
}
unset($frameLibsDir);
require_once SY_FRAME_LIBS_ROOT . 'helper_autoload.php';
