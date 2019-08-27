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
use Traits\SimpleFacadeTrait;
use Wx\WxUtilOpenBase;

class ThirdFastRegister extends WxOpenNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        if ($data['status'] == 0) {
            ProjectWxTool::handleAppAuthForOpen(Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED, [
                'AuthorizerAppid' => $data['appid'],
                'AuthorizationCode' => $data['auth_code'],
            ]);
            WxUtilOpenBase::getAuthorizerAccessToken($data['appid']);
        }
    }
}
