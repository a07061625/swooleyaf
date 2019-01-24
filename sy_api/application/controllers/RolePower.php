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
     */
    public function addPowerByStationAction(){
        $data = $_POST;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $addRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RolePower/addPowerByStation', $data);
        $this->sendRsp($addRes);
    }

    /**
     * 总站修改权限信息
     */
    public function editPowerByStationAction(){
        $data = $_POST;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $editRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RolePower/editPowerByStation', $data);
        $this->sendRsp($editRes);
    }

    /**
     * 总站修改角色权限
     */
    public function editRolePowersByStationAction(){
        $data = $_POST;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $editRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RolePower/editRolePowersByStation', $data);
        $this->sendRsp($editRes);
    }

    /**
     * 总站删除权限信息
     */
    public function delPowerByStationAction(){
        $data = $_GET;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $delRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RolePower/delPowerByStation', $data);
        $this->sendRsp($delRes);
    }

    /**
     * 总站获取权限信息
     */
    public function getPowerInfoByStationAction(){
        $data = $_GET;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RolePower/getPowerInfoByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 总站获取权限列表
     */
    public function getPowerListByStationAction(){
        $data = $_GET;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RolePower/getPowerListByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 总站获取角色权限列表
     */
    public function getRolePowersByStationAction(){
        $data = $_GET;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RolePower/getRolePowersByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 前端获取角色权限列表
     * @api {get} /Index/RolePower/getRolePowersByFront 前端获取角色权限列表
     * @apiDescription 前端获取角色权限列表
     * @apiGroup RolePower
     * @apiParam {string} role_tag 角色标识
     * @SyFilter-{"field": "role_tag","explain": "角色标识","type": "string","rules": {"required": 1,"regex": "/^[0-9a-z]{4}$/"}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getRolePowersByFrontAction(){
        $roleTag = (string)\Request\SyRequest::getParams('role_tag');
        $rolePowers = \ProjectCache\Role::getRolePowerList($roleTag);
        $this->SyResult->setData($rolePowers);
        $this->sendRsp();
    }
}