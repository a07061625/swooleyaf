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
     */
    public function addInfoByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $addRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/PermissionBase/addInfoByStation', $data);
        $this->sendRsp($addRes);
    }

    /**
     * 总站修改权限信息
     */
    public function editInfoByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $editRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/PermissionBase/editInfoByStation', $data);
        $this->sendRsp($editRes);
    }

    /**
     * 总站删除权限信息
     */
    public function delInfoByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $delRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/PermissionBase/delInfoByStation', $data);
        $this->sendRsp($delRes);
    }

    /**
     * 总站获取权限信息
     */
    public function getInfoByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/PermissionBase/getInfoByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 总站获取权限列表
     */
    public function getListByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/PermissionBase/getListByStation', $data);
        $this->sendRsp($getRes);
    }
}
