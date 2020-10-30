<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:45
 */
namespace DesignPatterns\Facades\WxOpenNotifyWx;

use DesignPatterns\Facades\WxOpenNotifyWxFacade;
use SyConstant\Project;
use SyTool\ProjectWxTool;
use SyTrait\SimpleFacadeTrait;

class UpdateAuthorized extends WxOpenNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        ProjectWxTool::handleAppAuthForOpen(Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED_UPDATE, $data);
    }
}
