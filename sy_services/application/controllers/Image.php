<?php
/**
 * 图片控制器
 * User: Administrator
 * Date: 2017-04-16
 * Time: 18:02
 */
class ImageController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 生成二维码图片
     *
     * @api {get} /Index/Image/createQrImage 生成二维码图片
     * @apiDescription 生成二维码图片
     * @apiGroup Image
     * @apiParam {string{1..255}} url 链接地址
     * @apiParam {number} [error_level=0] 容错级别,取值为0-3,越在前级别越低
     * @apiParam {number{1-10}} [image_size=5] 图片大小
     * @apiParam {number{0-200}} [margin_size=2] 外边框间隙,单位为px
     * @SyFilter-{"field": "url","explain": "链接地址","type": "string","rules": {"required": 1,"url": 1}}
     * @SyFilter-{"field": "error_level","explain": "容错级别","type": "int","rules": {"min": 0,"max": 3}}
     * @SyFilter-{"field": "image_size","explain": "图片大小","type": "int","rules": {"min": 1,"max": 10}}
     * @SyFilter-{"field": "margin_size","explain": "外边框间隙","type": "int","rules": {"min": 0,"max": 200}}
     * @apiSuccess {String} Body 图片字节流
     * @apiUse ResponseFail
     */
    public function createQrImageAction()
    {
        $url = (string)\Request\SyRequest::getParams('url');
        $qrBase = new \SyQr\QrBase($url, \SyServer\BaseServer::getServerConfig('storepath_cache'), [
            'error_level' => (int)\Request\SyRequest::getParams('error_level', 0),
            'image_size' => (int)\Request\SyRequest::getParams('image_size', 5),
            'margin_size' => (int)\Request\SyRequest::getParams('margin_size', 2),
        ]);

        $this->SyResult->setData([
            'image' => $qrBase->getContent(),
        ]);
        unset($qrBase);

        $this->sendRsp();
    }

    /**
     * 生成微信小程序二维码图片
     *
     * @api {get} /Index/Image/createQrImageWxMini 生成微信小程序二维码图片
     * @apiDescription 生成微信小程序二维码图片
     * @apiGroup Image
     * @apiParam {string{1..64}} wx_appid 小程序appid
     * @apiParam {string{1..255}} page_url 页面地址
     * @apiParam {string{1..32}} page_scene 页面场景
     * @apiParam {number{50-5000}} [image_size=430] 图片大小
     * @apiParam {number{0-1}} [hyaline=1] 透明背景标识 0:不透明 1:透明
     * @SyFilter-{"field": "wx_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1,"max": 64}}
     * @SyFilter-{"field": "page_url","explain": "页面地址","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "page_scene","explain": "页面场景","type": "string","rules": {"required": 1,"min": 1,"max": 32}}
     * @SyFilter-{"field": "image_size","explain": "图片大小","type": "int","rules": {"min": 50,"max": 5000}}
     * @SyFilter-{"field": "hyaline","explain": "透明背景标识","type": "int","rules": {"min": 0,"max": 1}}
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function createQrImageWxMiniAction()
    {
        $wxAppId = trim(\Request\SyRequest::getParams('wx_appid'));
        $pageUrl = trim(\Request\SyRequest::getParams('page_url'));
        $pageScene = trim(\Request\SyRequest::getParams('page_scene'));
        if (0 == strlen($wxAppId)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '小程序appid不能为空');
        } elseif (0 == strlen($pageUrl)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '页面地址不能为空');
        } elseif (0 == strlen($pageScene)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '页面场景不能为空');
        } else {
            $imageSize = (int)\Request\SyRequest::getParams('image_size', 430);
            $hyaline = (int)\Request\SyRequest::getParams('hyaline', 1);
            $qrCode = new \Wx\Mini\Qrcode($wxAppId);
            $qrCode->setPage($pageUrl);
            $qrCode->setScene($pageScene);
            $qrCode->setAutoColor(false);
            $qrCode->setWidth($imageSize);
            if (1 == $hyaline) {
                $qrCode->setIsHyaline(true);
            } else {
                $qrCode->setIsHyaline(false);
            }
            $createRes = $qrCode->getDetail();
            unset($qrCode);
            if (0 == $createRes['code']) {
                $this->SyResult->setData($createRes['data']);
            } else {
                $this->SyResult->setCodeMsg($createRes['code'], $createRes['message']);
            }
        }

        $this->sendRsp();
    }

    /**
     * 图片上传
     *
     * @api {post} /Index/Image/uploadImage 图片上传
     * @apiDescription 图片上传
     * @apiGroup Image
     * @apiParam {string} upload_type 上传类型,4位长度字符串
     * @apiParam {string} [image_base64] 图片base64编码
     * @apiParam {string} [image_url] 图片链接
     * @apiParam {string} [image_wxmedia] 微信媒体ID
     * @apiParam {number{1-5000}} image_width 图片限定宽度
     * @apiParam {number{1-5000}} image_height 图片限定高度
     * @SyFilter-{"field": "upload_type","explain": "上传类型","type": "int","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "image_width","explain": "图片限制宽度","type": "int","rules": {"required": 1,"min": 1,"max": 5000}}
     * @SyFilter-{"field": "image_height","explain": "图片限制高度","type": "int","rules": {"required": 1,"min": 1,"max": 5000}}
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function uploadImageAction()
    {
        $cacheKey = \SyConstant\Project::REDIS_PREFIX_IMAGE_DATA . \Request\SyRequest::getParams('_syfile_tag', '');
        $cacheData = \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->get($cacheKey);
        if (false === $cacheData) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_SERVER_ERROR, '图片缓存内容不存在');
        } else {
            \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->del($cacheKey);
            $imageWidth = (int)\Request\SyRequest::getParams('image_width');
            $imageHeight = (int)\Request\SyRequest::getParams('image_height');
            $syImage = new \SyImage\ImageImagick($cacheData, \SyConstant\SyInner::IMAGE_DATA_TYPE_BINARY);
            $fileName = $syImage->resizeImage($imageWidth, $imageHeight)
                ->setQuality(100)
                ->writeImage(\SyServer\BaseServer::getServerConfig('storepath_cache'));
            $this->SyResult->setData([
                'file_name' => $fileName,
            ]);
        }

        $this->sendRsp();
    }
}
