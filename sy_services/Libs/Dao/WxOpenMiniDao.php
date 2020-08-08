<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/17 0017
 * Time: 12:20
 */
namespace Dao;

use Factories\SyBaseMysqlFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;
use Wx\OpenMini\Category\CategoryGet;
use Wx\OpenMini\Code\CodeAudit;
use Wx\OpenMini\Code\CodeAuditStatus;
use Wx\OpenMini\Code\CodeRelease;
use Wx\OpenMini\Code\CodeUpload;
use Wx\OpenMini\Code\PageGet;
use Wx\OpenMini\CodeTemplate\DraftCodeList;
use Wx\OpenMini\CodeTemplate\TemplateCodeAdd;
use Wx\OpenMini\CodeTemplate\TemplateCodeDelete;
use Wx\OpenMini\CodeTemplate\TemplateCodeList;
use Wx\OpenMini\DomainModify;
use Wx\OpenMini\DomainWebViewSet;

class WxOpenMiniDao
{
    use SimpleDaoTrait;

    public static function getDraftCodeList(array $data)
    {
        $draftCodeList = new DraftCodeList();
        $codeList = $draftCodeList->getDetail();
        if ($codeList['code'] > 0) {
            throw new CheckException($codeList['message'], $codeList['code']);
        }

        return $codeList['data']['draft_list'];
    }

    public static function getTemplateCodeList(array $data)
    {
        $templateCodeList = new TemplateCodeList();
        $codeList = $templateCodeList->getDetail();
        if ($codeList['code'] > 0) {
            throw new CheckException($codeList['message'], $codeList['code']);
        }

        return $codeList['data']['template_list'];
    }

    public static function addTemplateCode(array $data)
    {
        $templateCodeAdd = new TemplateCodeAdd();
        $templateCodeAdd->setDraftId($data['draft_id']);
        $addRes = $templateCodeAdd->getDetail();
        if ($addRes['code'] > 0) {
            throw new CheckException($addRes['message'], $addRes['code']);
        }

        return [
            'msg' => '添加成功',
        ];
    }

    public static function delTemplateCode(array $data)
    {
        $templateCodeDelete = new TemplateCodeDelete();
        $templateCodeDelete->setTemplateId($data['template_id']);
        $delRes = $templateCodeDelete->getDetail();
        if ($delRes['code'] > 0) {
            throw new CheckException($delRes['message'], $delRes['code']);
        }

        return [
            'msg' => '删除成功',
        ];
    }

    public static function modifyServerDomain(array $data)
    {
        $serverDomain = new DomainModify($data['wxmini_appid']);
        $serverDomain->setModifyData($data['action_type'], $data['domains']);
        $modifyRes = $serverDomain->getDetail();
        if ($modifyRes['code'] > 0) {
            throw new CheckException($modifyRes['message'], $modifyRes['code']);
        }

        return $modifyRes['data'];
    }

    public static function setWebViewDomain(array $data)
    {
        $webViewDomain = new DomainWebViewSet($data['wxmini_appid']);
        $webViewDomain->setData($data['action_type'], $data['domains']);
        $setRes = $webViewDomain->getDetail();
        if ($setRes['code'] > 0) {
            throw new CheckException($setRes['message'], $setRes['code']);
        }

        return $setRes['data'];
    }

    public static function getMiniCategoryList(array $data)
    {
        $categoryGet = new CategoryGet($data['wxmini_appid']);
        $getRes = $categoryGet->getDetail();
        if ($getRes['code'] > 0) {
            throw new CheckException($getRes['message'], $getRes['code']);
        }

        return $getRes['data']['category_list'];
    }

    public static function getMiniPageConfig(array $data)
    {
        $pageGet = new PageGet($data['wxmini_appid']);
        $getRes = $pageGet->getDetail();
        if ($getRes['code'] > 0) {
            throw new CheckException($getRes['message'], $getRes['code']);
        }

        return $getRes['data']['page_list'];
    }

    public static function uploadMiniCode(array $data)
    {
        $codeUpload = new CodeUpload($data['wxmini_appid']);
        $codeUpload->setTemplateId($data['template_id']);
        $codeUpload->setExtData($data['ext_json']);
        $codeUpload->setUserVersion($data['user_version']);
        $codeUpload->setUserDesc($data['user_desc']);
        $uploadRes = $codeUpload->getDetail();
        if ($uploadRes['code'] > 0) {
            throw new CheckException($uploadRes['message'], $uploadRes['code']);
        }

        $wxMiniConfig = SyBaseMysqlFactory::getWxconfigMiniEntity();
        $ormResult1 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=?', [$data['wxmini_appid']]);
        $wxMiniConfig->getContainer()->getModel()->update($ormResult1, [
            'latest_code' => $data['template_id'],
            'audit_id' => '',
            'audit_status' => Project::WXMINI_AUDIT_STATUS_UNDO,
            'audit_desc' => '',
            'option_status' => Project::WXMINI_OPTION_STATUS_UPLOADED,
            'updated' => Tool::getNowTime(),
        ]);

        return [
            'msg' => '上传小程序代码成功',
        ];
    }

    public static function auditMiniCode(array $data)
    {
        $wxMiniConfig = SyBaseMysqlFactory::getWxconfigMiniEntity();
        $ormResult1 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=?', [$data['wxmini_appid']]);
        $wxInfo = $wxMiniConfig->getContainer()->getModel()->findOne($ormResult1);
        if (empty($wxInfo)) {
            throw new CheckException('微信信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        } elseif ($wxInfo['option_status'] != Project::WXMINI_OPTION_STATUS_UPLOADED) {
            throw new CheckException('未上传代码', ErrorCode::COMMON_PARAM_ERROR);
        }

        $codeAudit = new CodeAudit($data['wxmini_appid']);
        $codeAudit->setAuditList($data['audit_items']);
        $auditRes = $codeAudit->getDetail();
        if ($auditRes['code'] > 0) {
            throw new CheckException($auditRes['message'], $auditRes['code']);
        }

        $ormResult2 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`app_id`=? AND `option_status`=?', [$data['wxmini_appid'], Project::WXMINI_OPTION_STATUS_UPLOADED]);
        $wxMiniConfig->getContainer()->getModel()->update($ormResult2, [
            'audit_id' => $auditRes['data']['auditid'],
            'audit_status' => Project::WXMINI_AUDIT_STATUS_HANDING,
            'audit_desc' => '',
            'option_status' => Project::WXMINI_OPTION_STATUS_APPLY_AUDIT,
            'updated' => Tool::getNowTime(),
        ]);

        return [
            'audit_id' => $auditRes['data']['auditid'],
        ];
    }

    public static function refreshMiniCodeAuditResult(array $data)
    {
        $wxMiniConfig = SyBaseMysqlFactory::getWxconfigMiniEntity();
        $ormResult1 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=?', [$data['wxmini_appid']]);
        $wxInfo = $wxMiniConfig->getContainer()->getModel()->findOne($ormResult1);
        if (empty($wxInfo)) {
            throw new CheckException('微信信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        } elseif ($wxInfo['audit_id'] != $data['audit_id']) {
            throw new CheckException('微信appid和审核ID不匹配', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (!in_array($wxInfo['audit_status'], [Project::WXMINI_AUDIT_STATUS_UNDO, Project::WXMINI_AUDIT_STATUS_HANDING], true)) {
            throw new CheckException('审核状态不支持', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (in_array($wxInfo['audit_status'], [Project::WXMINI_AUDIT_STATUS_SUCCESS, Project::WXMINI_AUDIT_STATUS_FAIL], true)) {
            return [
                'audit_status' => $wxInfo['audit_status'],
                'audit_desc' => $wxInfo['audit_desc'],
                'msg' => '更新审核结果成功',
            ];
        }

        $codeAuditStatus = new CodeAuditStatus($data['wxmini_appid']);
        $codeAuditStatus->setAuditId($data['audit_id']);
        $getRes = $codeAuditStatus->getDetail();
        if ($getRes['code'] > 0) {
            throw new CheckException($getRes['message'], $getRes['code']);
        }

        $ormResult2 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`app_id`=? AND `audit_status`=?', [$data['wxmini_appid'], $wxInfo['audit_status']]);
        if ($getRes['data']['status'] == Project::WXMINI_AUDIT_STATUS_FAIL) {
            $wxMiniConfig->getContainer()->getModel()->update($ormResult2, [
                'audit_status' => Project::WXMINI_AUDIT_STATUS_FAIL,
                'audit_desc' => $getRes['data']['reason'],
                'option_status' => Project::WXMINI_OPTION_STATUS_AUDIT_FAIL,
                'updated' => Tool::getNowTime(),
            ]);
        } elseif ($getRes['data']['status'] == Project::WXMINI_AUDIT_STATUS_SUCCESS) {
            $wxMiniConfig->getContainer()->getModel()->update($ormResult2, [
                'audit_status' => Project::WXMINI_AUDIT_STATUS_SUCCESS,
                'audit_desc' => '',
                'option_status' => Project::WXMINI_OPTION_STATUS_AUDIT_SUCCESS,
                'updated' => Tool::getNowTime(),
            ]);
        } elseif ($wxInfo['audit_status'] == Project::WXMINI_AUDIT_STATUS_UNDO) {
            $wxMiniConfig->getContainer()->getModel()->update($ormResult2, [
                'audit_id' => '',
                'audit_status' => Project::WXMINI_AUDIT_STATUS_HANDING,
                'audit_desc' => '',
                'option_status' => Project::WXMINI_OPTION_STATUS_APPLY_AUDIT,
                'updated' => Tool::getNowTime(),
            ]);
        }

        return [
            'msg' => '更新审核结果成功',
            'audit_status' => $getRes['data']['status'],
            'audit_desc' => isset($getRes['data']['reason']) ? $getRes['data']['reason'] : '',
        ];
    }

    public static function releaseMiniCode(array $data)
    {
        $wxMiniConfig = SyBaseMysqlFactory::getWxconfigMiniEntity();
        $ormResult1 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=?', [$data['wxmini_appid']]);
        $wxInfo = $wxMiniConfig->getContainer()->getModel()->findOne($ormResult1);
        if (empty($wxInfo)) {
            throw new CheckException('微信信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        } elseif ($wxInfo['option_status'] != Project::WXMINI_OPTION_STATUS_AUDIT_SUCCESS) {
            throw new CheckException('只有审核成功才允许发布', ErrorCode::COMMON_PARAM_ERROR);
        }

        $codeRelease = new CodeRelease($data['wxmini_appid']);
        $releaseRes = $codeRelease->getDetail();
        if (($releaseRes['code'] > 0) && (strpos($releaseRes['message'], 'app is already released') === false)) {
            throw new CheckException($releaseRes['message'], $releaseRes['code']);
        }

        $ormResult2 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`app_id`=? AND `option_status`=?', [$data['wxmini_appid'], Project::WXMINI_OPTION_STATUS_AUDIT_SUCCESS]);
        $wxMiniConfig->getContainer()->getModel()->update($ormResult2, [
            'stable_code' => $wxInfo['latest_code'],
            'option_status' => Project::WXMINI_OPTION_STATUS_RELEASED,
            'updated' => Tool::getNowTime(),
        ]);

        return $releaseRes['code'] == 0 ? $releaseRes['data'] : [
            'type' => 1,
            'msg' => '发布成功',
        ];
    }

    public static function preUploadMiniCode(array $data)
    {
        $resArr = [
            'app_id' => '',
        ];

        $wxMiniConfig = SyBaseMysqlFactory::getWxconfigMiniEntity();
        $ormResult1 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`status`=? AND `wtype`=? AND `latest_code`<>?', [Project::WX_CONFIG_STATUS_ENABLE, Project::WXMINI_TYPE_SHOP_MINI, $data['template_id']])
                   ->order('`id` ASC');
        $wxInfo = $wxMiniConfig->getContainer()->getModel()->findOne($ormResult1);
        if (!empty($wxInfo)) {
            $resArr['app_id'] = $wxInfo['app_id'];
        }

        return $resArr;
    }

    public static function preAuditMiniCode(array $data)
    {
        $resArr = [
            'app_id' => '',
        ];

        $wxMiniConfig = SyBaseMysqlFactory::getWxconfigMiniEntity();
        $ormResult1 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`wtype`=? AND `status`=? AND `option_status`=?', [Project::WXMINI_TYPE_SHOP_MINI, Project::WX_CONFIG_STATUS_ENABLE, Project::WXMINI_OPTION_STATUS_UPLOADED])
                   ->order('`id` ASC');
        $wxInfo = $wxMiniConfig->getContainer()->getModel()->findOne($ormResult1);
        if (empty($wxInfo)) {
            unset($ormResult1, $wxMiniConfig);

            return $resArr;
        }
        $resArr['app_id'] = $wxInfo['app_id'];

        $categoryGet = new CategoryGet($wxInfo['app_id']);
        $getRes = $categoryGet->getDetail();
        if ($getRes['code'] > 0) {
            throw new CheckException($getRes['message'], $getRes['code']);
        } elseif (empty($getRes['data']['category_list'])) {
            throw new CheckException('可选类目为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        $resArr['items'] = [
            0 => $getRes['data']['category_list'][0],
        ];
        $resArr['items'][0]['address'] = 'pages/index/index';
        $resArr['items'][0]['tag'] = '小名片';
        $resArr['items'][0]['title'] = '小名片商城';

        return $resArr;
    }

    public static function preRefreshMiniCodeAuditResult(array $data)
    {
        $resArr = [
            'app_id' => '',
        ];

        $wxMiniConfig = SyBaseMysqlFactory::getWxconfigMiniEntity();
        $ormResult1 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`wtype`=? AND `status`=? AND `audit_status`=?', [Project::WXMINI_TYPE_SHOP_MINI, Project::WX_CONFIG_STATUS_ENABLE, Project::WXMINI_AUDIT_STATUS_HANDING])
                   ->order('`id` ASC');
        $wxInfo = $wxMiniConfig->getContainer()->getModel()->findOne($ormResult1);
        if (!empty($wxInfo)) {
            $resArr['app_id'] = $wxInfo['app_id'];
            $resArr['audit_id'] = $wxInfo['audit_id'];
        }

        return $resArr;
    }

    public static function preReleaseMiniCode(array $data)
    {
        $resArr = [
            'app_id' => '',
        ];

        $wxMiniConfig = SyBaseMysqlFactory::getWxconfigMiniEntity();
        $ormResult1 = $wxMiniConfig->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`wtype`=? AND `status`=? AND `option_status`=?', [Project::WXMINI_TYPE_SHOP_MINI, Project::WX_CONFIG_STATUS_ENABLE, Project::WXMINI_OPTION_STATUS_AUDIT_SUCCESS])
                   ->order('`id` ASC');
        $wxInfo = $wxMiniConfig->getContainer()->getModel()->findOne($ormResult1);
        if (!empty($wxInfo)) {
            $resArr['app_id'] = $wxInfo['app_id'];
        }

        return $resArr;
    }
}
