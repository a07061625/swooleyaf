<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/23 0023
 * Time: 9:19
 */
class RoleBaseController extends CommonController {
    public function init() {
        parent::init();
    }

    /**
     * 总站添加角色
     * @api {post} /Index/RoleBase/addRoleByStation 总站添加角色
     * @apiDescription 总站添加角色
     * @apiGroup RoleBase
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} tag 标识
     * @apiParam {string} title 标题
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 50}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function addRoleByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $title = \Tool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if(strlen($title) == 0){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $needParams = [
                'tag' => (string)\Request\SyRequest::getParams('tag'),
                'title' => $title,
            ];
            $addRes = \Dao\RoleBaseDao::addRoleByStation($needParams);
            $this->SyResult->setData($addRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站修改角色
     * @api {post} /Index/RoleBase/editRoleByStation 总站修改角色
     * @apiDescription 总站修改角色
     * @apiGroup RoleBase
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} tag 标识
     * @apiParam {string} title 标题
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 50}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function editRoleByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $title = \Tool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if(strlen($title) == 0){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $needParams = [
                'tag' => (string)\Request\SyRequest::getParams('tag'),
                'title' => $title,
            ];
            $editRes = \Dao\RoleBaseDao::editRoleByStation($needParams);
            $this->SyResult->setData($editRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站获取角色信息
     * @api {get} /Index/RoleBase/getRoleInfoByStation 总站获取角色信息
     * @apiDescription 总站获取角色信息
     * @apiGroup RoleBase
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} role_tag 角色标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "role_tag","explain": "角色标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getRoleInfoByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $needParams = [
            'role_tag' => (string)\Request\SyRequest::getParams('role_tag'),
        ];
        $getRes = \Dao\RoleBaseDao::getRoleInfoByStation($needParams);
        $this->SyResult->setData($getRes);

        $this->sendRsp();
    }

    /**
     * 总站获取角色列表
     * @api {get} /Index/RoleBase/getRoleListByStation 总站获取角色列表
     * @apiDescription 总站获取角色列表
     * @apiGroup RoleBase
     * @apiParam {string} session_id 会话ID
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=10] 分页限制
     * @apiParam {number} [role_status=-1] 角色状态 -2:所有 -1:已删除 0:无效 1:有效
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @SyFilter-{"field": "role_status","explain": "角色状态","type": "int","rules": {"min": -2,"max": 1}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getRoleListByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \Constant\Project::COMMON_LIMIT_DEFAULT),
            'role_status' => (int)\Request\SyRequest::getParams('role_status', -2),
        ];
        $getRes = \Dao\RoleBaseDao::getRoleListByStation($needParams);
        $this->SyResult->setData($getRes);

        $this->sendRsp();
    }

    /**
     * 前端获取角色列表
     * @api {get} /Index/RoleBase/getRoleListByFront 前端获取角色列表
     * @apiDescription 前端获取角色列表
     * @apiGroup RoleBase
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=10] 分页限制
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getRoleListByFrontAction(){
        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \Constant\Project::COMMON_LIMIT_DEFAULT),
        ];
        $getRes = \Dao\RoleBaseDao::getRoleListByFront($needParams);
        $this->SyResult->setData($getRes);

        $this->sendRsp();
    }
}