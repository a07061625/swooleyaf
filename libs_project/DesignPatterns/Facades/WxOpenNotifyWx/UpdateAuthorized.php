<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:45
 */
namespace DesignPatterns\Facades\WxOpenNotifyWx;

use Constant\Project;
use DesignPatterns\Facades\WxOpenNotifyWxFacade;
use Tool\ProjectTool;
use Traits\SimpleFacadeTrait;

class UpdateAuthorized extends WxOpenNotifyWxFacade {
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data){
        ProjectTool::handleAppAuthForWxOpen(Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED_UPDATE, $data);
    }
}