<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:44
 */
namespace DesignPatterns\Facades\WxOpenNotifyWx;

use Constant\Project;
use DesignPatterns\Facades\WxOpenNotifyWxFacade;
use Tool\ProjectTool;
use Traits\SimpleFacadeTrait;

class Unauthorized extends WxOpenNotifyWxFacade {
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data){
        ProjectTool::handleAppAuthForWxOpen(Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_UNAUTHORIZED, $data);
    }
}