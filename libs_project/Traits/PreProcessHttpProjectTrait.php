<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-20
 * Time: 下午7:20
 */
namespace Traits;

use Constant\Project;

/**
 * 项目HTTP服务预处理性状类
 * @package Traits
 */
trait PreProcessHttpProjectTrait {
    private $preProcessMapProject = [
        Project::PRE_PROCESS_TAG_HTTP_PROJECT_TEST => 'preProcessProjectTest',
    ];

    private function preProcessProjectTest(\swoole_http_request $request) : string {
        return 'http project test';
    }
}