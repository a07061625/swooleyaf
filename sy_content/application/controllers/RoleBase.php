<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/23 0023
 * Time: 9:19
 */
class RoleBaseController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 总站添加角色
     *
     * @api {post} /Index/RoleBase/addInfoByStation 总站添加角色
     * @apiDescription 总站添加角色
     * @apiGroup RoleBase
     * @apiParam {string} tag 标识
     * @apiParam {string} title 标题
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 50}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function addInfoByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $title = SyTool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if (strlen($title) == 0) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $needParams = [
                'tag' => (string)\Request\SyRequest::getParams('tag'),
                'title' => $title,
            ];
            $addRes = \Dao\RoleBaseDao::addInfoByStation($needParams);
            $this->SyResult->setData($addRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站修改角色
     *
     * @api {post} /Index/RoleBase/editInfoByStation 总站修改角色
     * @apiDescription 总站修改角色
     * @apiGroup RoleBase
     * @apiParam {string} tag 标识
     * @apiParam {string} title 标题
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 50}}
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
                'tag' => (string)\Request\SyRequest::getParams('tag'),
                'title' => $title,
            ];
            $editRes = \Dao\RoleBaseDao::editInfoByStation($needParams);
            $this->SyResult->setData($editRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站获取角色信息
     *
     * @api {get} /Index/RoleBase/getInfoByStation 总站获取角色信息
     * @apiDescription 总站获取角色信息
     * @apiGroup RoleBase
     * @apiParam {string} role_tag 角色标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "role_tag","explain": "角色标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getInfoByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'role_tag' => (string)\Request\SyRequest::getParams('role_tag'),
        ];
        $getRes = \Dao\RoleBaseDao::getInfoByStation($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 总站获取角色列表
     *
     * @api {get} /Index/RoleBase/getListByStation 总站获取角色列表
     * @apiDescription 总站获取角色列表
     * @apiGroup RoleBase
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=10] 分页限制
     * @apiParam {number} [role_status=-1] 角色状态 -2:所有 -1:已删除 0:无效 1:有效
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @SyFilter-{"field": "role_status","explain": "角色状态","type": "int","rules": {"min": -2,"max": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getListByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \SyConstant\Project::COMMON_LIMIT_DEFAULT),
            'role_status' => (int)\Request\SyRequest::getParams('role_status', -2),
        ];
        $getRes = \Dao\RoleBaseDao::getListByStation($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 总站修改角色权限
     *
     * @api {post} /Index/RoleBase/editRolePermissionsByStation 总站修改角色权限
     * @apiDescription 总站修改角色权限
     * @apiGroup RoleBase
     * @apiParam {string} role_tag 角色标识
     * @apiParam {string} role_powers 权限列表,多个权限标识之间用英文逗号拼接
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "role_tag","explain": "角色标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @SyFilter-{"field": "permission_list","explain": "权限列表","type": "string","rules": {"required": 1,"min": 0}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function editRolePermissionsByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $permissionStr = trim(\Request\SyRequest::getParams('permission_list', ''));
        if ((strlen($permissionStr) > 0) && (preg_match('/^(\,[0-9a-z]{3}|\,[0-9a-z]{6}|\,[0-9a-z]{9})+$/', ',' . $permissionStr) == 0)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '权限标识不合法');
        } else {
            $permissionArr = [];
            $permissionList = strlen($permissionStr) > 0 ? explode(',', $permissionStr) : [];
            array_unique($permissionList);
            sort($permissionList, SORT_STRING);
            foreach ($permissionList as $ePermissionTag) {
                $tagLength = strlen($ePermissionTag);
                $needTag = substr($ePermissionTag, 0, 3);
                if (isset($permissionArr[$needTag])) {
                    continue;
                }
                if ($tagLength >= 6) {
                    $needTag = substr($ePermissionTag, 0, 6);
                    if (isset($permissionArr[$needTag])) {
                        continue;
                    }
                }
                $permissionArr[$ePermissionTag] = 1;
            }

            $needParams = [
                'role_tag' => (string)\Request\SyRequest::getParams('role_tag'),
                'permission_list' => array_keys($permissionArr),
            ];
            $editRes = \Dao\RoleBaseDao::editRolePermissionsByStation($needParams);
            $this->SyResult->setData($editRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站获取角色权限列表
     *
     * @api {get} /Index/RoleBase/getRolePermissionsByStation 总站获取角色权限列表
     * @apiDescription 总站获取角色权限列表
     * @apiGroup RoleBase
     * @apiParam {string} role_tag 角色标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "role_tag","explain": "角色标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getRolePermissionsByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'role_tag' => (string)\Request\SyRequest::getParams('role_tag'),
        ];
        $getRes = \Dao\RoleBaseDao::getRolePermissionsByStation($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 前端获取角色列表
     *
     * @api {get} /Index/RoleBase/getListByFront 前端获取角色列表
     * @apiDescription 前端获取角色列表
     * @apiGroup RoleBase
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=10] 分页限制
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getListByFrontAction()
    {
        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \SyConstant\Project::COMMON_LIMIT_DEFAULT),
        ];
        $getRes = \Dao\RoleBaseDao::getListByFront($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }
}
