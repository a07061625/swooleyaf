<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:42
 */
namespace DesignPatterns\Facades\WxOpenNotifyWx;

use Constant\Project;
use DesignPatterns\Facades\WxOpenNotifyWxFacade;
use Tool\ProjectWxTool;
use SyTrait\SimpleFacadeTrait;

class Authorized extends WxOpenNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        ProjectWxTool::handleAppAuthForOpen(Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED, $data);
    }
}
