<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/21 0021
 * Time: 9:28
 */
namespace Helper;

use SyConstant\SyInner;
use SyServer\HttpServer;
use SyServer\ProcessPoolServer;
use SyServer\RpcServer;
use SyServerRegister\Nginx\Http;
use SyTool\Tool;
use SyTrait\SimpleTrait;

class ServiceRunner
{
    use SimpleTrait;

    private static function registerService(string $action, string $serverType, array $params)
    {
        if ($serverType != 'http') {
            return;
        }

        $registerRes = [];
        $registerType = trim(Tool::getClientOption('-rt', false, ''));
        if ($registerType == SyInner::SERVER_REGISTER_TYPE_NGINX) {
            $register = new Http();
            $register->setHost($params['host']);
            $register->setPort($params['port']);
            $registerRes = $register->operatorServer($action);
        }

        if (!empty($registerRes)) {
            if ($registerRes['code'] == 0) {
                $tipStr = 'echo -e "\e[1;32m ' . $registerRes['data'] . ' \e[0m"';
            } else {
                $tipStr = 'echo -e "\e[1;31m ' . $registerRes['msg'] . ' \e[0m"';
            }
            system($tipStr);
        }
    }

    /**
     * @param string $apiName api模块名称
     * @param array $totalModule 包含所有模块的数组
     */
    public static function run(string $apiName, array $totalModule)
    {
        $projectName = trim(Tool::getClientOption('-n', false, ''));
        if (strlen($projectName) == 0) {
            exit('参数 -n 服务项目名称无效,必须与项目目录相同,否则无法加载 profile文件' . PHP_EOL);
        }

        $projectPath = SY_ROOT . '/' . $projectName;
        if (!is_dir($projectPath)) {
            exit($projectName . ' dir not exist' . PHP_EOL);
        }
        define('APP_PATH', $projectPath);

        $moduleName = trim(Tool::getClientOption('-module', false, ''));
        if (strlen($moduleName) == 0) {
            exit('module name must exist' . PHP_EOL);
        } elseif (!in_array($moduleName, $totalModule, true)) {
            exit('module name error' . PHP_EOL);
        }
        define('SY_MODULE', $moduleName);

        $port = trim(Tool::getClientOption('-port', false, ''));
        if (!ctype_digit($port)) {
            exit('port must exist and is integer' . PHP_EOL);
        }
        $truePort = (int)$port;

        if ($moduleName == $apiName) {
            $server = new HttpServer($truePort);
        } else {
            $server = new RpcServer($truePort);
        }

        $action = Tool::getClientOption('-s', false, 'start');
        switch ($action) {
            case 'start':
                $server->start();
                if ($moduleName == $apiName) {
                    self::registerService('add', 'http', [
                        'host' => $server->getHost(),
                        'port' => $server->getPort(),
                    ]);
                }
                break;
            case 'stop':
                $server->stop();
                if ($moduleName == $apiName) {
                    self::registerService('remove', 'http', [
                        'host' => $server->getHost(),
                        'port' => $server->getPort(),
                    ]);
                }
                break;
            case 'restart':
                $server->stop();
                if ($moduleName == $apiName) {
                    self::registerService('remove', 'http', [
                        'host' => $server->getHost(),
                        'port' => $server->getPort(),
                    ]);
                }
                sleep(3);
                $server->start();
                if ($moduleName == $apiName) {
                    self::registerService('add', 'http', [
                        'host' => $server->getHost(),
                        'port' => $server->getPort(),
                    ]);
                }
                break;
            case 'kz':
                $server->killZombies();
                break;
            case 'startstatus':
                $server->getStartStatus();
                break;
            default:
                $server->help();
        }
    }

    public static function runProcessPool()
    {
        $moduleName = trim(Tool::getClientOption('-module', false, ''));
        if (strlen($moduleName) == 0) {
            exit('module name must exist' . PHP_EOL);
        }
        define('SY_MODULE', $moduleName);

        $port = trim(Tool::getClientOption('-port', false, ''));
        if (!ctype_digit($port)) {
            exit('port must exist and is integer' . PHP_EOL);
        }
        $truePort = (int)$port;

        $server = new ProcessPoolServer($truePort);

        $action = Tool::getClientOption('-s', false, 'start');
        switch ($action) {
            case 'start':
                $server->start();
                break;
            case 'stop':
                $server->stop();
                break;
            case 'restart':
                $server->stop();
                sleep(3);
                $server->start();
                break;
            case 'startstatus':
                $server->getStartStatus();
                break;
            default:
                $server->help();
        }
    }
}
