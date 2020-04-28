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
     * @api {post} /Index/Region/addRegionByStation 总站添加地区
     * @apiDescription 总站添加地区
     * @apiGroup Region
     * @apiParam {string} region_name 地区名称
     * @apiParam {number} region_sort 地区排序
     * @apiParam {number} region_level 地区级别
     * @apiParam {string} region_ptag 父地区标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "region_name","explain": "地区名称","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "region_sort","explain": "地区排序","type": "int","rules": {"required": 1,"min": 1,"max": 1000}}
     * @SyFilter-{"field": "region_level","explain": "地区级别","type": "int","rules": {"required": 1,"min": 1,"max": 3}}
     * @SyFilter-{"field": "region_ptag","explain": "父地区标识","type": "string","rules": {"min": 0,"max": 6}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function addRegionByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $regionName = SyTool\ProjectTool::filterStr(\Request\SyRequest::getParams('region_name'));
        $nameLength = mb_strlen($regionName);
        if ($nameLength == 0) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '地区名称不能为空');
        } elseif ($nameLength < 2) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '地区名称不能小于两个字');
        } elseif ($nameLength > 100) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '地区名称不能大于100个字');
        } else {
            $needParams = [
                'region_name' => $regionName,
                'region_sort' => (int) \Request\SyRequest::getParams('region_sort'),
                'region_level' => (int) \Request\SyRequest::getParams('region_level'),
            ];
            $addRes = \Dao\RegionDao::addRegionByStation($needParams);
            $this->SyResult->setData($addRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站修改地区
     * @api {post} /Index/Region/editRegionByStation 总站修改地区
     * @apiDescription 总站修改地区
     * @apiGroup Region
     * @apiParam {string} [region_name] 地区名称
     * @apiParam {number} [region_sort] 地区排序
     * @apiParam {number} region_level 地区级别 1:省 2:市 3:县
     * @apiParam {string} region_tag 地区标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "region_name","explain": "地区名称","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "region_sort","explain": "地区排序","type": "int","rules": {"min": 0,"max": 1000}}
     * @SyFilter-{"field": "region_level","explain": "地区级别","type": "int","rules": {"required": 1,"min": 1,"max": 3}}
     * @SyFilter-{"field": "region_tag","explain": "地区标识","type": "string","rules": {"required": 1,"min": 3,"max": 9}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function editRegionByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $regionName = SyTool\ProjectTool::filterStr(\Request\SyRequest::getParams('region_name', ''));
        $nameLength = mb_strlen($regionName);
        if ($nameLength > 100) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '地区名称不能大于100个字');
        } elseif ($nameLength == 1) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '地区名称不能小于两个字');
        } else {
            $needParams = [
                'region_name' => $regionName,
                'region_sort' => (int) \Request\SyRequest::getParams('region_sort', 0),
                'region_level' => (int) \Request\SyRequest::getParams('region_level'),
            ];
            $addRes = \Dao\RegionDao::editRegionByStation($needParams);
            $this->SyResult->setData($addRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站删除地区
     * @api {get} /Index/Region/deleteRegionByStation 总站删除地区
     * @apiDescription 总站删除地区
     * @apiGroup Region
     * @apiParam {string} region_tag 地区标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "region_tag","explain": "地区标识","type": "string","rules": {"required": 1,"min": 3,"max": 9}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function deleteRegionByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'region_tag' => (string) \Request\SyRequest::getParams('region_tag'),
        ];
        $delRes = \Dao\RegionDao::deleteRegionByStation($needParams);
        $this->SyResult->setData($delRes);
        $this->sendRsp();
    }

    /**
     * 总站获取单个地区信息
     * @api {get} /Index/Region/getRegionInfoByStation 总站获取单个地区信息
     * @apiDescription 总站获取单个地区信息
     * @apiGroup Region
     * @apiParam {string} region_tag 地区标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "region_tag","explain": "地区标识","type": "string","rules": {"required": 1,"min": 3,"max": 9}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getRegionInfoByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $regionTag = (string) \Request\SyRequest::getParams('region_tag');
        $tagLength = strlen($regionTag);
        if (!in_array($tagLength, [3, 6, 9], true)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '地区标识不合法');
        } else {
            $needParams = [
                'region_tag' => $regionTag,
                'region_level' => (int) ($tagLength / 3),
            ];
            $getRes = \Dao\RegionDao::getRegionInfoByStation($needParams);
            $this->SyResult->setData($getRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站获取地区列表
     * @api {get} /Index/Region/getRegionListByStation 总站获取地区列表
     * @apiDescription 总站获取地区列表
     * @apiGroup Region
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=10] 分页限制
     * @apiParam {string} [region_ptag] 父地区标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @SyFilter-{"field": "region_ptag","explain": "父地区标识","type": "string","rules": {"min": 0,"max": 6}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getRegionListByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $ptag = trim(\Request\SyRequest::getParams('region_ptag', ''));
        $tagLength = strlen($ptag);
        if (!in_array($tagLength, [0, 3, 6], true)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '父地区标识不合法');
        } else {
            $needParams = [
                'page' => (int) \Request\SyRequest::getParams('page', 1),
                'limit' => (int) \Request\SyRequest::getParams('limit', \SyConstant\Project::COMMON_LIMIT_DEFAULT),
                'region_ptag' => $ptag,
            ];
            if ($tagLength == 0) {
                $needParams['region_level'] = \SyConstant\Project::REGION_LEVEL_TYPE_PROVINCE;
            } elseif ($tagLength == 3) {
                $needParams['region_level'] = \SyConstant\Project::REGION_LEVEL_TYPE_CITY;
            } else {
                $needParams['region_level'] = \SyConstant\Project::REGION_LEVEL_TYPE_COUNTY;
            }
            $getRes = \Dao\RegionDao::getRegionListByStation($needParams);
            $this->SyResult->setData($getRes);
        }

        $this->sendRsp();
    }

    /**
     * 前端获取单个地区信息
     * @api {get} /Index/Region/getRegionInfoByFront 前端获取单个地区信息
     * @apiDescription 前端获取单个地区信息
     * @apiGroup Region
     * @apiParam {string} region_tag 地区标识
     * @SyFilter-{"field": "region_tag","explain": "地区标识","type": "string","rules": {"required": 1,"min": 3,"max": 9}}
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getRegionInfoByFrontAction()
    {
        $regionTag = (string) \Request\SyRequest::getParams('region_tag');
        $tagLength = strlen($regionTag);
        if (in_array($tagLength, [3, 6, 9], true)) {
            $needParams = [
                'region_tag' => $regionTag,
            ];
            $getRes = \Dao\RegionDao::getRegionInfoByFront($needParams);
            $this->SyResult->setData($getRes);
        } else {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '地区标识不合法');
        }

        $this->sendRsp();
    }
}
