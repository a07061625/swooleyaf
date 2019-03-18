<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/1 0001
 * Time: 11:32
 */
namespace SyError;

use Constant\ErrorCode;
use Constant\Server;
use Exception\Common\ErrorException;
use Log\Log;
use Yaf\Registry;

class ErrorHandler {
    private function __construct(){
    }

    /**
     * 处理错误
     * @param int $errNo
     * @param string $errStr
     * @param string $errFile
     * @param int $errLine
     * @throws \Exception\Common\ErrorException
     */
    public static function handleError($errNo, $errStr, $errFile, $errLine) {
        switch ($errNo) {
            case E_NOTICE:
            case E_WARNING:
            case E_COMPILE_WARNING:
            case E_USER_NOTICE:
                Registry::set(Server::REGISTRY_NAME_SERVICE_ERROR, ErrorCode::COMMON_SERVER_ERROR);
                $errMsg = $errStr . ' at ' . str_replace(SY_ROOT, '.', $errFile) . '(' . $errLine . ')';
                throw new ErrorException($errMsg, ErrorCode::COMMON_SERVER_ERROR);
                break;
        }
    }

    /**
     * 处理未捕获异常
     */
    public static function handleException(\Throwable $exception) {
        $msg = 'sy exception - ' . $exception->getMessage();
        Log::error($msg, $exception->getCode(), $exception->getTraceAsString());

        Registry::set(Server::REGISTRY_NAME_SERVICE_ERROR, ErrorCode::COMMON_SERVER_EXCEPTION);
    }

    /**
     * 处理致命错误
     */
    public static function handleFatalError(){
        $error = error_get_last();
        if (!empty($error)) {
            switch($error['type']){
                case E_ERROR:
                case E_PARSE:
                case E_CORE_ERROR:
                case E_COMPILE_ERROR:
                case E_USER_ERROR:
                case E_RECOVERABLE_ERROR:
                    $msg = 'sy fatal error - ' . $error['message'] . ' at ' . $error['file'] . '(' . $error['line'] . ')';
                    Log::error($msg);
                    unset($msg);
                    Registry::set(Server::REGISTRY_NAME_SERVICE_ERROR, ErrorCode::COMMON_SERVER_FATAL);
                    break;
            }
        }
        unset($error);
    }
}