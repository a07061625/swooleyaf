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
     */
    public function addInfoByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $addRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/addInfoByStation', $data);
        $this->sendRsp($addRes);
    }

    /**
     * 总站修改角色
     */
    public function editInfoByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $editRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/editInfoByStation', $data);
        $this->sendRsp($editRes);
    }

    /**
     * 总站获取角色信息
     */
    public function getInfoByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/getInfoByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 总站获取角色列表
     */
    public function getListByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/getListByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 总站修改角色权限
     */
    public function editRolePermissionsByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $editRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/editRolePermissionsByStation', $data);
        $this->sendRsp($editRes);
    }

    /**
     * 总站获取角色权限列表
     */
    public function getRolePermissionsByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/getRolePermissionsByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 前端获取角色列表
     */
    public function getListByFrontAction()
    {
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/RoleBase/getListByFront', $_GET);
        $this->sendRsp($getRes);
    }
}
