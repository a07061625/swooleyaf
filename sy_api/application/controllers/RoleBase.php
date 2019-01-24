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
     */
    public function addRoleByStationAction(){
        $data = $_POST;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $addRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/addRoleByStation', $data);
        $this->sendRsp($addRes);
    }

    /**
     * 总站修改角色
     */
    public function editRoleByStationAction(){
        $data = $_POST;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $editRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/editRoleByStation', $data);
        $this->sendRsp($editRes);
    }

    /**
     * 总站获取角色信息
     */
    public function getRoleInfoByStationAction(){
        $data = $_GET;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/getRoleInfoByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 总站获取角色列表
     */
    public function getRoleListByStationAction(){
        $data = $_GET;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/getRoleListByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 前端获取角色列表
     */
    public function getRoleListByFrontAction(){
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/getRoleListByFront', $_GET);
        $this->sendRsp($getRes);
    }
}