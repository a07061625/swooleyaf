<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/23 0023
 * Time: 9:19
 */
class PermissionBaseController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 总站添加权限信息
     *
     * @api {post} /Index/PermissionBase/addInfoByStation 总站添加权限信息
     * @apiDescription 总站添加权限信息
     * @apiGroup PermissionBase
     * @apiParam {string} tag 标识,由小写字母和数字组成的3位字符串
     * @apiParam {string} [ptag] 父标识
     * @apiParam {string} title 标题
     * @apiParam {string} [path_icon] 图标
     * @apiParam {string} [path_redirect] 重定向地址
     * @apiParam {number} [sort_num=0] 排序值,数字越大越在前
     * @apiParam {number} node_type 节点类型,1:树杈节点 2:叶子节点
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{3}$/"}}
     * @SyFilter-{"field": "ptag","explain": "父标识","type": "string","rules": {"regex": "/^([0-9a-z]{3}){0,2}$/"}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 50}}
     * @SyFilter-{"field": "path_icon","explain": "图标","type": "string","rules": {"min": 0,"max": 200}}
     * @SyFilter-{"field": "path_redirect","explain": "重定向地址","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "sort_num","explain": "排序值","type": "int","rules": {"min": 0,"max": 1000}}
     * @SyFilter-{"field": "node_type","explain": "节点类型","type": "int","rules": {"required": 1,"min": 1,"max": 2}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function addInfoByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $tag = (string)\Request\SyRequest::getParams('tag');
        $parentTag = (string)\Request\SyRequest::getParams('ptag', '');
        $levelNum = (int)(strlen($parentTag) / 3 + 1);
        $title = SyTool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if (($levelNum == 1) && ctype_digit($tag[0])) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '标识必须以字母开头');
        }
        if (strlen($title) == 0) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $needParams = [
                'tag' => $parentTag . $tag,
                'ptag' => $parentTag,
                'level_num' => $levelNum,
                'title' => $title,
                'path_icon' => trim(\Request\SyRequest::getParams('path_icon', '')),
                'path_redirect' => trim(\Request\SyRequest::getParams('path_redirect', '')),
                'sort_num' => (int)\Request\SyRequest::getParams('sort_num', 0),
                'node_type' => (int)\Request\SyRequest::getParams('node_type'),
            ];
            $addRes = \Dao\PermissionBaseDao::addInfoByStation($needParams);
            $this->SyResult->setData($addRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站修改权限信息
     *
     * @api {post} /Index/PermissionBase/editInfoByStation 总站修改权限信息
     * @apiDescription 总站修改权限信息
     * @apiGroup PermissionBase
     * @apiParam {string} permission_tag 权限标识
     * @apiParam {string} title 标题
     * @apiParam {string} [path_icon] 图标
     * @apiParam {string} [path_redirect] 重定向地址
     * @apiParam {number} [sort_num=0] 排序值,数字越大越在前
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "permission_tag","explain": "权限标识","type": "string","rules": {"required": 1,"regex": "/^([0-9a-z]{3}){1,3}$/"}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 50}}
     * @SyFilter-{"field": "path_icon","explain": "图标","type": "string","rules": {"min": 0,"max": 200}}
     * @SyFilter-{"field": "path_redirect","explain": "重定向地址","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "sort_num","explain": "排序值","type": "int","rules": {"min": 0,"max": 1000}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function editInfoByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $title = SyTool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if (strlen($title) == 0) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $needParams = [
                'permission_tag' => (string)\Request\SyRequest::getParams('permission_tag'),
                'title' => $title,
                'path_icon' => trim(\Request\SyRequest::getParams('path_icon', '')),
                'path_redirect' => trim(\Request\SyRequest::getParams('path_redirect', '')),
                'sort_num' => (int)\Request\SyRequest::getParams('sort_num', 0),
            ];
            $editRes = \Dao\PermissionBaseDao::editInfoByStation($needParams);
            $this->SyResult->setData($editRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站删除权限信息
     *
     * @api {get} /Index/PermissionBase/delInfoByStation 总站删除权限信息
     * @apiDescription 总站删除权限信息
     * @apiGroup PermissionBase
     * @apiParam {string} permission_tag 权限标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "permission_tag","explain": "权限标识","type": "string","rules": {"required": 1,"regex": "/^([0-9a-z]{3}){1,3}$/"}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function delInfoByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'permission_tag' => (string)\Request\SyRequest::getParams('permission_tag'),
        ];
        $delRes = \Dao\PermissionBaseDao::delInfoByStation($needParams);
        $this->SyResult->setData($delRes);
        $this->sendRsp();
    }

    /**
     * 总站获取权限信息
     *
     * @api {get} /Index/PermissionBase/getInfoByStation 总站获取权限信息
     * @apiDescription 总站获取权限信息
     * @apiGroup PermissionBase
     * @apiParam {string} permission_tag 权限标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "permission_tag","explain": "权限标识","type": "string","rules": {"required": 1,"regex": "/^([0-9a-z]{3}){1,3}$/"}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getInfoByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'permission_tag' => (string)\Request\SyRequest::getParams('permission_tag'),
        ];
        $getRes = \Dao\PermissionBaseDao::getInfoByStation($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 总站获取权限列表
     *
     * @api {get} /Index/PermissionBase/getListByStation 总站获取权限列表
     * @apiDescription 总站获取权限列表
     * @apiGroup PermissionBase
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=10] 分页限制
     * @apiParam {string} [ptag] 父标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @SyFilter-{"field": "ptag","explain": "父标识","type": "string","rules": {"regex": "/^([0-9a-z]{3}){0,3}$/"}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getListByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $parentTag = (string)\Request\SyRequest::getParams('ptag', '');
        $parentTagLength = strlen($parentTag);
        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \SyConstant\Project::COMMON_LIMIT_DEFAULT),
            'ptag' => $parentTag,
            'level_num' => (int)($parentTagLength / 3 + 1),
        ];
        $getRes = \Dao\PermissionBaseDao::getListByStation($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }
}
