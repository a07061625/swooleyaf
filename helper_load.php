<?php
define('SY_ROOT', __DIR__);
define('SY_ENV', 'dev');
define('SY_PROJECT', 'a01');
define('SY_DATABASE', true);
define('SY_LC_WX_ACCOUNT', true);
define('SY_LC_WXOPEN_AUTHORIZER', true);
define('SY_PROJECT_LIBS_ROOT', SY_ROOT . '/libs_project/');
//前两位为数字的内部自用,放出去的都是前两位非数字的
define('SY_TOKEN', '245dcbf2');
define('SY_TOKEN_SECRET', 'eyJpdiI6ImY2OGE2MDBmNmMxYjExNmMiLCJ2YWx1ZSI6IkdESm5vcFBHSlltU0FCc3R3bm1zZDBCb0poVWtkQ0R2bU1lOFVUdGdBekE9In0=');

$frameLibsDir = \Yaconf::get('project.' . SY_ENV . SY_PROJECT . '.dir.libs.frame');
if (substr($frameLibsDir, -1) == '/') {
    define('SY_FRAME_LIBS_ROOT', $frameLibsDir);
} else {
    define('SY_FRAME_LIBS_ROOT', $frameLibsDir . '/');
}
unset($frameLibsDir);
require_once SY_FRAME_LIBS_ROOT . 'helper_autoload.php';
