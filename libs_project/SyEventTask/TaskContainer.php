<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/28 0028
 * Time: 9:12
 */
namespace SyEventTask;

use SyConstant\Project;
use SyEventTask\Frame\TokenRefresh;
use SyEventTask\Frame\WxLocalClear;
use SyTool\BaseContainer;

/**
 * Class TaskContainer
 *
 * @package SyEventTask
 */
class TaskContainer extends BaseContainer
{
    public function __construct()
    {
        $this->registryMap = [
            Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE => 1,
            Project::TASK_TYPE_REFRESH_TOKEN_EXPIRE => 1,
        ];

        $this->bind(Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE, function () {
            return new WxLocalClear();
        });
        $this->bind(Project::TASK_TYPE_REFRESH_TOKEN_EXPIRE, function () {
            return new TokenRefresh();
        });
    }
}
