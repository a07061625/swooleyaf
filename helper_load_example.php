<?php
const SY_ROOT = __DIR__;
const SY_ENV = 'dev';
const SY_PROJECT = 'a01';
const SY_DATABASE = true;
const SY_LC_WX_ACCOUNT = true;
const SY_LC_WXOPEN_AUTHORIZER = true;
const SY_PROJECT_LIBS_ROOT = SY_ROOT . '/libs_project/';
//前两位为数字的内部自用,放出去的都是前两位非数字的
const SY_TOKEN = '245dcbf2';
const SY_TOKEN_SECRET = 'eyJpdiI6ImY2OGE2MDBmNmMxYjExNmMiLCJ2YWx1ZSI6IkdESm5vcFBHSlltU0FCc3R3bm1zZDBCb0poVWtkQ0R2bU1lOFVUdGdBekE9In0=';

$frameLibsDir = \Yaconf::get('project.' . SY_ENV . SY_PROJECT . '.dir.libs.frame');
if ('/' == substr($frameLibsDir, -1)) {
    define('SY_FRAME_LIBS_ROOT', $frameLibsDir);
} else {
    define('SY_FRAME_LIBS_ROOT', $frameLibsDir . '/');
}
unset($frameLibsDir);
require_once SY_FRAME_LIBS_ROOT . 'helper_autoload.php';
