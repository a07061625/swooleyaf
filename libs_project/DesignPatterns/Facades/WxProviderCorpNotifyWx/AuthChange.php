<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 15:27
 */
namespace DesignPatterns\Facades\WxProviderCorpNotifyWx;

use DesignPatterns\Facades\WxProviderCorpNotifyWxFacade;
use SyConstant\Project;
use SyTool\ProjectWxTool;
use SyTrait\SimpleFacadeTrait;

class AuthChange extends WxProviderCorpNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        ProjectWxTool::handleAuthForCorpProvider(Project::WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CHANGE, $data);
    }
}
