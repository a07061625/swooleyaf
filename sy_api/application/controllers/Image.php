<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-17
 * Time: 下午10:23
 */
class ImageController extends CommonController {
    public $signStatus = false;

    public function init() {
        parent::init();
        $this->signStatus = false;
    }

    /**
     * 获取百度编辑器配置
     * @api {get} /Index/Image/index 获取百度编辑器配置
     * @apiDescription 获取百度编辑器配置
     * @apiGroup File
     * @apiParam {string} action 动作名称 config:获取配置 uploadimage:上传图片
     * @apiParam {string} [callback] 回调函数名
     * @SyFilter-{"field": "action","explain": "动作名称","type": "string","rules": {"min": 1,"required":1}}
     * @SyFilter-{"field": "callback","explain": "回调函数名","type": "string","rules": {"min": 0}}
     */
    public function indexAction() {
        $action = (string)\Request\SyRequest::getParams('action');
        $handleRes = \Dao\ApiImageDao::indexUeditorHandle($action);
        if(is_string($handleRes)){
            $this->sendRsp($handleRes);
        } else {
            $this->sendRsp(\Tool\Tool::jsonEncode($handleRes));
        }
    }

    public function createQrImageAction() {
        $res = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/Image/createQrImage', $_GET);
        $this->sendRsp($res);
    }

    /**
     * 生成微信小程序二维码图片
     */
    public function createQrImageWxMiniAction() {
        $res = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/Image/createQrImageWxMini', $_GET);
        $this->sendRsp($res);
    }

    public function createCodeImageAction() {
        $data = $_GET;
        $data['session_id'] = \Tool\SySession::getSessionId();
        $res = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/Image/createCodeImage', $data);
        $this->sendRsp($res);
    }

    /**
     * 上传图片
     * @SyFilter-{"field": "upload_type","explain": "上传类型","type": "int","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "image_base64","explain": "图片base64内容","type": "string","rules": {"baseimage": 1}}
     * @SyFilter-{"field": "image_url","explain": "图片链接","type": "string","rules": {"url": 1}}
     * @SyFilter-{"field": "image_wxmedia","explain": "微信媒体ID","type": "string","rules": {"min": 1}}
     */
    public function uploadImageAction() {
        //思想-不管何种方式的图片上传,都转换成base64编码传递给services服务
        //上传类型 1:文件上传 2:base64上传 3:url上传 4:微信媒体上传
        $uploadType = (int)\Request\SyRequest::getParams('upload_type');
        $handleRes = \Dao\ApiImageDao::uploadImageHandle($uploadType);
        $uploadRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/Image/uploadImage', $handleRes);
        $this->sendRsp($uploadRes);
    }

    /**
     * 获取前端OSS配置,用于前端直接post文件到oss
     * @api {post} /Index/Image/getFrontOSSConfig 获取前端OSS配置,用于前端直接post文件到oss
     * @apiDescription 获取前端OSS配置,用于前端直接post文件到oss
     * @apiGroup File
     * @apiParam {string} upload_type 上传类型 video:视频 image:图片
     * @SyFilter-{"field": "upload_type","explain": "上传类型","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getFrontOSSConfigAction(){
        $uploadType = (string)\Request\SyRequest::getParams('upload_type');
        if(!in_array($uploadType, ['video', 'image'])){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '上传类型不支持');
        } else {
            $nowTime = \Tool\Tool::getNowTime();
            $expireTime = $nowTime + 1800;
            $maxFileSize = $uploadType == 'image' ? 5242880 : 62914560;
            $uploadPath = $uploadType . '/' . date('Ym', $nowTime) . '/';
            $successStatus = '200';
            $signRes = \AliOss\OssTool::signFrontPolicy([
                'expiration' => gmdate("Y-m-d\TH:i:s.000\Z", $expireTime),
                'conditions' => [
                    ['content-length-range', 1, $maxFileSize],
                    ['starts-with', '$key', $uploadPath],
                    ['success_action_status' => $successStatus],
                ],
            ]);

            $ossConfig = \DesignPatterns\Singletons\AliOssSingleton::getInstance()->getOssConfig();
            $this->SyResult->setData([
                'key_id' => $ossConfig->getAccessKeyId(),
                'policy' => $signRes['policy_sign'],
                'signature' => $signRes['signature'],
                'upload_path' => $uploadPath,
                'bucket_domain' => $ossConfig->getBucketDomain(),
                'oss_host' => 'http://' . $ossConfig->getBucketName() . '.oss-cn-shenzhen.aliyuncs.com',
                'max_size' => $maxFileSize,
                'success_status' => $successStatus,
                'expire_time' => $expireTime,
            ]);
        }

        $this->sendRsp();
    }
}