<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:44
 */
namespace DesignPatterns\Facades\WxOpenNotifyWx;

use DesignPatterns\Facades\WxOpenNotifyWxFacade;
use SyConstant\Project;
use SyTool\ProjectWxTool;
use SyTrait\SimpleFacadeTrait;

class Unauthorized extends WxOpenNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        ProjectWxTool::handleAppAuthForOpen(Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_UNAUTHORIZED, $data);
    }
}
