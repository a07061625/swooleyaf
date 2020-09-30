<?php
/**
 * 阿里配置
 * User: 姜伟
 * Date: 2019/8/10 0010
 * Time: 15:50
 */
class AliConfigController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 获取前端OSS配置,用于前端直接post文件到oss
     *
     * @api {post} /Index/AliConfig/getOssFront 获取前端OSS配置,用于前端直接post文件到oss
     * @apiDescription 获取前端OSS配置,用于前端直接post文件到oss
     * @apiGroup AliConfig
     * @apiParam {string} upload_type 上传类型 video:视频 image:图片
     * @SyFilter-{"field": "upload_type","explain": "上传类型","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getOssFrontAction()
    {
        $needParams = [
            'access_key' => '1111',
            'upload_type' => (string)\Request\SyRequest::getParams('upload_type'),
        ];
        $getRes = \Dao\AliConfigDao::getOssFront($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }
}
