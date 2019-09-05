<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 15:27
 */
namespace DesignPatterns\Facades\WxProviderCorpNotifyWx;

use SyConstant\Project;
use DesignPatterns\Facades\WxProviderCorpNotifyWxFacade;
use Tool\ProjectWxTool;
use SyTrait\SimpleFacadeTrait;

class AuthCreate extends WxProviderCorpNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        ProjectWxTool::handleAuthForCorpProvider(Project::WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CREATE, $data);
    }
}
