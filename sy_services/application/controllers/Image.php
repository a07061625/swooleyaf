<?php
/**
 * 图片控制器
 * User: Administrator
 * Date: 2017-04-16
 * Time: 18:02
 */
class ImageController extends CommonController {
    public function init() {
        parent::init();
    }

    /**
     * 生成二维码图片
     * @api {get} /Index/Image/createQrImage 生成二维码图片
     * @apiDescription 生成二维码图片
     * @apiGroup File
     * @apiParam {string{1..255}} url 链接地址
     * @apiParam {string} [error_level=L] 容错级别，取值为H L M Q，越在前级别越低
     * @apiParam {number{1-10}} [image_size=5] 图片大小
     * @apiParam {number{0-200}} [margin_size=2] 外边框间隙，单位为px
     * @apiSuccess {string} Body 图片字节流
     * @apiUse CommonFail
     * @SyFilter-{"field": "url","explain": "链接地址","type": "string","rules": {"required": 1,"url": 1}}
     * @SyFilter-{"field": "error_level","explain": "容错级别","type": "string","rules": {"regex": "/^[HLMQ]{1}$/"}}
     * @SyFilter-{"field": "image_size","explain": "图片大小","type": "int","rules": {"min": 1,"max": 10}}
     * @SyFilter-{"field": "margin_size","explain": "外边框间隙","type": "int","rules": {"min": 0,"max": 200}}
     */
    public function createQrImageAction() {
        $url = (string)\Request\SyRequest::getParams('url');
        ob_start();
        \Qrcode\SyQrCode::createImage($url, [
            'error_level' => \Request\SyRequest::getParams('error_level', \Qrcode\SyQrCode::QR_ERROR_LEVEL_ONE),
            'image_size' => (int)\Request\SyRequest::getParams('image_size', 5),
            'margin_size' => (int)\Request\SyRequest::getParams('margin_size', 2),
        ]);
        $image = ob_get_contents();
        ob_end_clean();

        $this->SyResult->setData([
            'image' => 'data:image/png;base64,' . base64_encode($image),
        ]);

        $this->sendRsp();
    }

    /**
     * 生成微信小程序二维码图片
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
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function createQrImageWxMiniAction() {
        $wxAppId = trim(\Request\SyRequest::getParams('wx_appid'));
        $pageUrl = trim(\Request\SyRequest::getParams('page_url'));
        $pageScene = trim(\Request\SyRequest::getParams('page_scene'));
        if(strlen($wxAppId) == 0){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '小程序appid不能为空');
        } else if(strlen($pageUrl) == 0){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '页面地址不能为空');
        } else if(strlen($pageScene) == 0){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '页面场景不能为空');
        } else {
            $imageSize = (int)\Request\SyRequest::getParams('image_size', 430);
            $hyaline = (int)\Request\SyRequest::getParams('hyaline', 1);
            $qrCode = new \Wx\Mini\Qrcode($wxAppId);
            $qrCode->setPage($pageUrl);
            $qrCode->setScene($pageScene);
            $qrCode->setAutoColor(false);
            $qrCode->setWidth($imageSize);
            if($hyaline == 1){
                $qrCode->setIsHyaline(true);
            } else {
                $qrCode->setIsHyaline(false);
            }
            $createRes = $qrCode->getDetail();
            unset($qrCode);
            if($createRes['code'] == 0){
                $this->SyResult->setData($createRes['data']);
            } else {
                $this->SyResult->setCodeMsg($createRes['code'], $createRes['message']);
            }
        }

        $this->sendRsp();
    }

    /**
     * 生成验证码图片
     * @api {get} /Index/Image/createCodeImage 生成验证码图片
     * @apiDescription 生成验证码图片
     * @apiGroup File
     * @apiParam {string{1..64}} session_id 令牌标识
     * @apiParam {number{50-150}} [image_width=130] 图片宽度
     * @apiParam {number{20-80}} [image_height=45] 图片高度
     * @SyFilter-{"field": "session_id","explain": "令牌标识","type": "string","rules": {"required": 1,"min": 1,"max": 150}}
     * @SyFilter-{"field": "image_width","explain": "图片宽度","type": "int","rules": {"required": 1,"min": 50,"max": 150}}
     * @SyFilter-{"field": "image_height","explain": "图片高度","type": "int","rules": {"required": 1,"min": 20,"max": 80}}
     * @apiSuccess {string} Body 图片字节流
     * @apiUse CommonFail
     */
    public function createCodeImageAction() {
        $fontPath = \SyServer\HttpServer::getServerConfig('storepath_resources') . '/consolas.ttf';
        //创建图片
        $imageWidth = (int)\Request\SyRequest::getParams('image_width', 130);
        $imageHeight = (int)\Request\SyRequest::getParams('image_height', 45);
        $image = imagecreate($imageWidth, $imageHeight);
        imagecolorallocate($image, rand(50, 200), rand(0, 155), rand(0, 155)); //第一次对 imagecolorallocate() 的调用会给基于调色板的图像填充背景色
        $fontColor = imageColorAllocate($image, 255, 255, 255);   //字体颜色
        $code = '';
        //产生随机字符
        for ($i = 0; $i < 4; $i++) {
            $randAsciiNumArray = array(rand(48, 57), rand(65, 90));
            $randAsciiNum = $randAsciiNumArray[rand(0, 1)];
            $randStr = chr($randAsciiNum);
            imagettftext($image, 30, rand(0, 20) - rand(0, 25), 5 + $i * 30, rand(30, 35), $fontColor, $fontPath, $randStr);
            $code .= $randStr;
        }
        //干扰线
        for ($i = 0; $i < 8; $i++) {
            $lineColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            imageline($image, rand(0, $imageWidth), 0, rand(0, $imageWidth), $imageHeight, $lineColor);
        }
        //干扰点
        for ($i = 0; $i < 250; $i++) {
            imagesetpixel($image, rand(0, $imageWidth), rand(0, $imageHeight), $fontColor);
        }

        ob_start();
        imagepng($image);
        $imageContent = ob_get_contents();
        ob_end_clean();

        imagedestroy($image);

        //随机字符串放入redis
        $redis = \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance();
        $redisKey = \Constant\Project::REDIS_PREFIX_CODE_IMAGE . \Request\SyRequest::getParams('session_id');
        $redis->set($redisKey, $code, 190);

        $this->SyResult->setData([
            'image' => 'data:image/png;base64,' . base64_encode($imageContent),
        ]);

        $this->sendRsp();
    }

    /**
     * 图片上传
     * @api {post} /Index/Image/uploadImage 图片上传
     * @apiDescription 图片上传
     * @apiGroup File
     * @apiParam {string} upload_type 上传类型,4位长度字符串
     * @apiParam {string} [image_base64] 图片base64编码
     * @apiParam {string} [image_url] 图片链接
     * @apiParam {string} [image_wxmedia] 微信媒体ID
     * @apiParam {number{1-5000}} image_width 图片限定宽度
     * @apiParam {number{1-5000}} image_height 图片限定高度
     * @SyFilter-{"field": "upload_type","explain": "上传类型","type": "int","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "image_width","explain": "图片限制宽度","type": "int","rules": {"required": 1,"min": 1,"max": 5000}}
     * @SyFilter-{"field": "image_height","explain": "图片限制高度","type": "int","rules": {"required": 1,"min": 1,"max": 5000}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function uploadImageAction() {
        $cacheKey = \Constant\Project::REDIS_PREFIX_IMAGE_DATA . \Request\SyRequest::getParams('_syfile_tag', '');
        $cacheData = \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->get($cacheKey);
        if ($cacheData === false) {
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_SERVER_ERROR, '图片缓存内容不存在');
        } else {
            \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->del($cacheKey);
            $imageWidth = (int)\Request\SyRequest::getParams('image_width');
            $imageHeight = (int)\Request\SyRequest::getParams('image_height');
            $syImage = new Images\SyImageImagick($cacheData);
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