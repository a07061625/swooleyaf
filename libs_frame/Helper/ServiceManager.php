<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/21 0021
 * Time: 9:27
 */
namespace Helper;

use SyConstant\SyInner;
use SyTool\Tool;
use SyTrait\SimpleTrait;

class ServiceManager
{
    use SimpleTrait;

    private static function createCommandStr(string $commandPrefix, array $commandParams) : string
    {
        $commandStr = $commandPrefix;
        foreach ($commandParams as $paramKey => $paramVal) {
            $commandStr .= ' ' . trim($paramKey);
            $trueVal = trim($paramVal);
            if (strlen($trueVal) > 0) {
                $commandStr .= ' ' . $trueVal;
            }
        }

        return $commandStr;
    }

    private static function getServiceParamsCommon(array $projectInfo, array $listenInfo, array &$commandParams)
    {
        $commandParams['-n'] = $projectInfo['module_path'];
        $commandParams['-module'] = $projectInfo['module_name'];
        $commandParams['-port'] = $listenInfo['port'];
    }

    private static function getServiceParamsRegister(array $listenInfo, array &$commandParams)
    {
        $commandParams['-rt'] = $listenInfo['register_type'] ?? '';
        if ($commandParams['-rt'] == SyInner::SERVER_REGISTER_TYPE_NGINX) {
            $commandParams['-weight'] = $listenInfo['ng_weight'] ?? 1;
            $commandParams['-maxfails'] = $listenInfo['ng_max_fails'] ?? 3;
            $commandParams['-failtimeout'] = $listenInfo['ng_fail_timeout'] ?? 30;
            $commandParams['-backup'] = $listenInfo['ng_backup'] ?? 0;
        }
    }

    private static function getProcessPoolParamsCommon(array $poolInfo, array $listenInfo, array &$commandParams)
    {
        $commandParams['-st'] = 'processpool';
        $commandParams['-module'] = $poolInfo['module_name'];
        $commandParams['-port'] = $listenInfo['port'];
    }

    public static function handleAllService(string $commandPrefix, array $projects)
    {
        $action = Tool::getClientOption('-s', false, '');
        switch ($action) {
            case 'start-all':
                foreach ($projects as $eProject) {
                    foreach ($eProject['listens'] as $eListen) {
                        $params1 = [
                            '-s' => 'start',
                        ];
                        self::getServiceParamsCommon($eProject, $eListen, $params1);
                        self::getServiceParamsRegister($eListen, $params1);
                        $command1 = self::createCommandStr($commandPrefix, $params1);

                        $params2 = [
                            '-s' => 'startstatus',
                        ];
                        self::getServiceParamsCommon($eProject, $eListen, $params2);
                        $command2 = self::createCommandStr($commandPrefix, $params2);
                        system($command1 . ' && ' . $command2);
                    }
                }
                break;
            case 'stop-all':
                foreach ($projects as $eProject) {
                    foreach ($eProject['listens'] as $eListen) {
                        $params = [
                            '-s' => 'stop',
                        ];
                        self::getServiceParamsCommon($eProject, $eListen, $params);
                        self::getServiceParamsRegister($eListen, $params);
                        $command = self::createCommandStr($commandPrefix, $params);
                        system($command);
                    }
                }
                break;
            case 'restart-all':
                foreach ($projects as $eProject) {
                    foreach ($eProject['listens'] as $eListen) {
                        $params1 = [
                            '-s' => 'restart',
                        ];
                        self::getServiceParamsCommon($eProject, $eListen, $params1);
                        self::getServiceParamsRegister($eListen, $params1);
                        $command1 = self::createCommandStr($commandPrefix, $params1);

                        $params2 = [
                            '-s' => 'startstatus',
                        ];
                        self::getServiceParamsCommon($eProject, $eListen, $params2);
                        $command2 = self::createCommandStr($commandPrefix, $params2);
                        system($command1 . ' && ' . $command2);
                    }
                }
                break;
            case 'kz-all':
                foreach ($projects as $eProject) {
                    foreach ($eProject['listens'] as $eListen) {
                        $params = [
                            '-s' => 'kz',
                        ];
                        self::getServiceParamsCommon($eProject, $eListen, $params);
                        $command = self::createCommandStr($commandPrefix, $params);
                        system($command);
                    }
                }
                break;
            default:
                system('echo -e "\e[1;31m command not exist \e[0m"');
        }
    }

    public static function handleAllProcessPool(string $commandPrefix, array $pools)
    {
        $action = Tool::getClientOption('-s', false, '');
        switch ($action) {
            case 'start-all':
                foreach ($pools as $ePool) {
                    foreach ($ePool['listens'] as $eListen) {
                        $params1 = [
                            '-s' => 'start',
                        ];
                        self::getProcessPoolParamsCommon($ePool, $eListen, $params1);
                        $command1 = self::createCommandStr($commandPrefix, $params1);

                        $params2 = [
                            '-s' => 'startstatus',
                        ];
                        self::getProcessPoolParamsCommon($ePool, $eListen, $params2);
                        $command2 = self::createCommandStr($commandPrefix, $params2);
                        system($command1 . ' && ' . $command2);
                    }
                }
                break;
            case 'stop-all':
                foreach ($pools as $ePool) {
                    foreach ($ePool['listens'] as $eListen) {
                        $params = [
                            '-s' => 'stop',
                        ];
                        self::getProcessPoolParamsCommon($ePool, $eListen, $params);
                        $command = self::createCommandStr($commandPrefix, $params);
                        system($command);
                    }
                }
                break;
            case 'restart-all':
                foreach ($pools as $ePool) {
                    foreach ($ePool['listens'] as $eListen) {
                        $params1 = [
                            '-s' => 'restart',
                        ];
                        self::getProcessPoolParamsCommon($ePool, $eListen, $params1);
                        $command1 = self::createCommandStr($commandPrefix, $params1);

                        $params2 = [
                            '-s' => 'startstatus',
                        ];
                        self::getProcessPoolParamsCommon($ePool, $eListen, $params2);
                        $command2 = self::createCommandStr($commandPrefix, $params2);
                        system($command1 . ' && ' . $command2);
                    }
                }
                break;
            default:
                system('echo -e "\e[1;31m command not exist \e[0m"');
        }
    }
}
