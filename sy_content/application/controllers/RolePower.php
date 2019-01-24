<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/23 0023
 * Time: 9:19
 */
class RolePowerController extends CommonController {
    public function init() {
        parent::init();
    }

    /**
     * 总站添加权限信息
     * @api {post} /Index/RolePower/addPowerByStation 总站添加权限信息
     * @apiDescription 总站添加权限信息
     * @apiGroup RolePower
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} tag 标识,由小写字母和数字组成的3位字符串
     * @apiParam {string} [ptag] 父标识
     * @apiParam {string} title 标题
     * @apiParam {string} [icon] 图标
     * @apiParam {string} [path] 路由
     * @apiParam {number} [sort_num=0] 排序值,数字越大越在前
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{3}$/"}}
     * @SyFilter-{"field": "ptag","explain": "父标识","type": "string","rules": {"regex": "/^([0-9a-z]{3}){0,2}$/"}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 50}}
     * @SyFilter-{"field": "icon","explain": "图标","type": "string","rules": {"min": 0,"max": 200}}
     * @SyFilter-{"field": "path","explain": "路由","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "sort_num","explain": "排序值","type": "int","rules": {"min": 0,"max": 1000}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function addPowerByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $title = \Tool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if(strlen($title) == 0){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $parentTag = (string)\Request\SyRequest::getParams('ptag', '');
            $parentTagLength = strlen($parentTag);
            $needParams = [
                'tag' => $parentTag . \Request\SyRequest::getParams('tag'),
                'ptag' => $parentTag,
                'level' => (int)($parentTagLength / 3 + 1),
                'title' => $title,
                'icon' => trim(\Request\SyRequest::getParams('icon', '')),
                'path' => trim(\Request\SyRequest::getParams('path', '')),
                'sort_num' => (int)\Request\SyRequest::getParams('sort_num', 0),
            ];
            $addRes = \Dao\RolePowerDao::addPowerByStation($needParams);
            $this->SyResult->setData($addRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站修改权限信息
     * @api {post} /Index/RolePower/editPowerByStation 总站修改权限信息
     * @apiDescription 总站修改权限信息
     * @apiGroup RolePower
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} power_tag 权限标识
     * @apiParam {string} title 标题
     * @apiParam {string} [icon] 图标
     * @apiParam {string} [path] 路由
     * @apiParam {number} [sort_num=0] 排序值,数字越大越在前
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "power_tag","explain": "权限标识","type": "string","rules": {"required": 1,"regex": "/^([0-9a-z]{3}){1,3}$/"}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 50}}
     * @SyFilter-{"field": "icon","explain": "图标","type": "string","rules": {"min": 0,"max": 200}}
     * @SyFilter-{"field": "path","explain": "路由","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "sort_num","explain": "排序值","type": "int","rules": {"min": 0,"max": 1000}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function editPowerByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $title = \Tool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if(strlen($title) == 0){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $needParams = [
                'power_tag' => (string)\Request\SyRequest::getParams('power_tag'),
                'title' => $title,
                'icon' => trim(\Request\SyRequest::getParams('icon', '')),
                'path' => trim(\Request\SyRequest::getParams('path', '')),
                'sort_num' => (int)\Request\SyRequest::getParams('sort_num', 0),
            ];
            $editRes = \Dao\RolePowerDao::editPowerByStation($needParams);
            $this->SyResult->setData($editRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站修改角色权限
     * @api {post} /Index/RolePower/editRolePowersByStation 总站修改角色权限
     * @apiDescription 总站修改角色权限
     * @apiGroup RolePower
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} role_tag 角色标识
     * @apiParam {string} role_powers 权限列表,多个权限标识之间用英文逗号拼接
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "role_tag","explain": "角色标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @SyFilter-{"field": "role_powers","explain": "权限列表","type": "string","rules": {"required": 1,"min": 0}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function editRolePowersByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $rolePowers = trim(\Request\SyRequest::getParams('role_powers', ''));
        if((strlen($rolePowers) > 0) && (preg_match('/^(\,[0-9a-z]{3}|\,[0-9a-z]{6}|\,[0-9a-z]{9})+$/', ',' . $rolePowers) == 0)){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '权限标识不合法');
        } else {
            $powerList = [];
            $rolePowerList = strlen($rolePowers) > 0 ? explode(',', $rolePowers) : [];
            array_unique($rolePowerList);
            sort($rolePowerList, SORT_STRING);
            foreach ($rolePowerList as $ePowerTag) {
                $tagLength = strlen($ePowerTag);
                if($tagLength == 3){
                    $powerList[$ePowerTag] = 1;
                } else if($tagLength == 6){
                    $subTag = substr($ePowerTag, 0, 3);
                    if(!isset($powerList[$subTag])){
                        $powerList[$ePowerTag] = 1;
                    }
                } else {
                    $subTag1 = substr($ePowerTag, 0, 3);
                    $subTag2 = substr($ePowerTag, 3, 3);
                    if((!isset($powerList[$subTag1])) && (!isset($powerList[$subTag2]))){
                        $powerList[$ePowerTag] = 1;
                    }
                }
            }

            $needParams = [
                'role_tag' => (string)\Request\SyRequest::getParams('role_tag'),
                'role_powers' => array_keys($powerList),
            ];
            $editRes = \Dao\RolePowerDao::editRolePowersByStation($needParams);
            $this->SyResult->setData($editRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站删除权限信息
     * @api {get} /Index/RolePower/delPowerByStation 总站删除权限信息
     * @apiDescription 总站删除权限信息
     * @apiGroup RolePower
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} power_tag 权限标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "power_tag","explain": "权限标识","type": "string","rules": {"required": 1,"regex": "/^([0-9a-z]{3}){1,3}$/"}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function delPowerByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $needParams = [
            'power_tag' => (string)\Request\SyRequest::getParams('power_tag'),
        ];
        $delRes = \Dao\RolePowerDao::delPowerByStation($needParams);
        $this->SyResult->setData($delRes);

        $this->sendRsp();
    }

    /**
     * 总站获取权限信息
     * @api {get} /Index/RolePower/getPowerInfoByStation 总站获取权限信息
     * @apiDescription 总站获取权限信息
     * @apiGroup RolePower
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} power_tag 权限标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "power_tag","explain": "权限标识","type": "string","rules": {"required": 1,"regex": "/^([0-9a-z]{3}){1,3}$/"}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getPowerInfoByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $needParams = [
            'power_tag' => (string)\Request\SyRequest::getParams('power_tag'),
        ];
        $getRes = \Dao\RolePowerDao::getPowerInfoByStation($needParams);
        $this->SyResult->setData($getRes);

        $this->sendRsp();
    }

    /**
     * 总站获取权限列表
     * @api {get} /Index/RolePower/getPowerListByStation 总站获取权限列表
     * @apiDescription 总站获取权限列表
     * @apiGroup RolePower
     * @apiParam {string} session_id 会话ID
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=10] 分页限制
     * @apiParam {string} [ptag] 父标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @SyFilter-{"field": "ptag","explain": "父标识","type": "string","rules": {"regex": "/^([0-9a-z]{3}){0,3}$/"}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getPowerListByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $parentTag = (string)\Request\SyRequest::getParams('ptag', '');
        $parentTagLength = strlen($parentTag);
        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \Constant\Project::COMMON_LIMIT_DEFAULT),
            'ptag' => $parentTag,
            'level' => (int)($parentTagLength / 3 + 1),
        ];
        $getRes = \Dao\RolePowerDao::getPowerListByStation($needParams);
        $this->SyResult->setData($getRes);

        $this->sendRsp();
    }

    /**
     * 总站获取角色权限列表
     * @api {get} /Index/RolePower/getRolePowersByStation 总站获取角色权限列表
     * @apiDescription 总站获取角色权限列表
     * @apiGroup RolePower
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} role_tag 角色标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "role_tag","explain": "角色标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getRolePowersByStationAction(){
        \Tool\SyUser::checkStationLogin();

        $needParams = [
            'role_tag' => (string)\Request\SyRequest::getParams('role_tag'),
        ];
        $getRes = \Dao\RolePowerDao::getRolePowersByStation($needParams);
        $this->SyResult->setData($getRes);

        $this->sendRsp();
    }
}