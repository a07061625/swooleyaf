<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/30 0030
 * Time: 17:05
 */
class RegionController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 总站添加地区
     */
    public function addRegionByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $addRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/Region/addRegionByStation', $data);
        $this->sendRsp($addRes);
    }

    /**
     * 总站修改地区
     */
    public function editRegionByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $editRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/Region/editRegionByStation', $data);
        $this->sendRsp($editRes);
    }

    /**
     * 总站删除地区
     */
    public function deleteRegionByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $delRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/Region/deleteRegionByStation', $data);
        $this->sendRsp($delRes);
    }

    /**
     * 总站获取单个地区信息
     */
    public function getRegionInfoByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/Region/getRegionInfoByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 总站获取地区列表
     */
    public function getRegionListByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/Region/getRegionListByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 前端获取单个地区信息
     */
    public function getRegionInfoByFrontAction()
    {
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/Region/getRegionInfoByFront', $_GET);
        $this->sendRsp($getRes);
    }

    /**
     * 前端获取地区列表
     * @api {get} /Index/Region/getRegionListByFront 前端获取地区列表
     * @apiDescription 前端获取地区列表
     * @apiGroup Region
     * @apiParam {string} [region_tag] 地区标识,只支持省标识
     * @SyFilter-{"field": "region_tag","explain": "地区标识","type": "string","rules": {"min": 0,"max": 3}}
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getRegionListByFrontAction()
    {
        $regionTag = trim(\Request\SyRequest::getParams('region_tag', ''));
        $regionList = \ProjectCache\Region::getRegionList($regionTag);
        $this->SyResult->setData($regionList);
        $this->sendRsp();
    }
}
