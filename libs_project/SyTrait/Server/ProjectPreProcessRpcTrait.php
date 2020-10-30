<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-20
 * Time: 下午7:20
 */
namespace SyTrait\Server;

use SyConstant\Project;

/**
 * 项目RPC服务预处理性状类
 *
 * @package SyTrait\Server
 */
trait ProjectPreProcessRpcTrait
{
    private $preProcessMapProject = [
        Project::PRE_PROCESS_TAG_RPC_PROJECT_TEST => 'preProcessProjectTest',
    ];

    private function preProcessProjectTest(array $data) : string
    {
        return 'rpc project test';
    }
}
