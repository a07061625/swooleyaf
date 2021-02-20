<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-17
 * Time: 下午10:23
 */
class ImageController extends CommonController
{
    public $signStatus = false;

    public function init()
    {
        parent::init();
        $this->signStatus = false;
    }

    /**
     * 获取百度编辑器配置
     * @api {get} /Index/Image/index 获取百度编辑器配置
     * @apiDescription 获取百度编辑器配置
     * @apiGroup Image
     * @apiParam {string} action 动作名称 config:获取配置 uploadimage:上传图片
     * @apiParam {string} [callback] 回调函数名
     * @SyFilter-{"field": "action","explain": "动作名称","type": "string","rules": {"min": 1,"required":1}}
     * @SyFilter-{"field": "callback","explain": "回调函数名","type": "string","rules": {"min": 0}}
     */
    public function indexAction()
    {
        $action = (string)\Request\SyRequest::getParams('action');
        $handleRes = \Dao\ApiImageDao::indexUeditorHandle($action);
        if (is_string($handleRes)) {
            $this->sendRsp($handleRes);
        } else {
            $this->sendRsp(SyTool\Tool::jsonEncode($handleRes));
        }
    }

    public function createQrImageAction()
    {
        $createRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/Image/createQrImage', $_GET);
        $this->sendRsp($createRes);
    }

    /**
     * 生成微信小程序二维码图片
     */
    public function createQrImageWxMiniAction()
    {
        $createRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/Image/createQrImageWxMini', $_GET);
        $this->sendRsp($createRes);
    }

    /**
     * 生成验证码图片
     * @api {get} /Index/Image/createCodeImage 生成验证码图片
     * @apiDescription 生成验证码图片
     * @apiGroup Image
     * @apiParam {string{1..64}} session_id 令牌标识
     * @apiParam {number{50-150}} [image_width=130] 图片宽度
     * @apiParam {number{20-80}} [image_height=45] 图片高度
     * @SyFilter-{"field": "session_id","explain": "令牌标识","type": "string","rules": {"required": 1,"min": 1,"max": 150}}
     * @SyFilter-{"field": "image_width","explain": "图片宽度","type": "int","rules": {"required": 1,"min": 50,"max": 150}}
     * @SyFilter-{"field": "image_height","explain": "图片高度","type": "int","rules": {"required": 1,"min": 20,"max": 80}}
     * @apiSuccess {String} Body 图片字节流
     * @apiUse ResponseFail
     */
    public function createCodeImageAction()
    {
        $fontPath = \SyServer\HttpServer::getServerConfig('storepath_resources') . '/consolas.ttf';
        //创建图片
        $imageWidth = (int)\Request\SyRequest::getParams('image_width', 130);
        $imageHeight = (int)\Request\SyRequest::getParams('image_height', 45);
        $image = imagecreate($imageWidth, $imageHeight);
        imagecolorallocate($image, random_int(50, 200), random_int(0, 155), random_int(0, 155)); //第一次对imagecolorallocate()的调用会给基于调色板的图像填充背景色
        $fontColor = imageColorAllocate($image, 255, 255, 255); //字体颜色
        $code = '';
        //产生随机字符
        for ($i = 0; $i < 4; $i++) {
            $randAsciiNumArray = [random_int(48, 57), random_int(65, 90)];
            $randAsciiNum = $randAsciiNumArray[random_int(0, 1)];
            $randStr = chr($randAsciiNum);
            imagettftext($image, 30, random_int(0, 20) - random_int(0, 25), 5 + $i * 30, random_int(30, 35), $fontColor, $fontPath, $randStr);
            $code .= $randStr;
        }
        //干扰线
        for ($i = 0; $i < 8; $i++) {
            $lineColor = imagecolorallocate($image, random_int(0, 255), random_int(0, 255), random_int(0, 255));
            imageline($image, random_int(0, $imageWidth), 0, random_int(0, $imageWidth), $imageHeight, $lineColor);
        }
        //干扰点
        for ($i = 0; $i < 250; $i++) {
            imagesetpixel($image, random_int(0, $imageWidth), random_int(0, $imageHeight), $fontColor);
        }

        ob_start();
        imagepng($image);
        $imageContent = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);

        //随机字符串放入redis
        $redisKey = \SyConstant\Project::REDIS_PREFIX_CODE_IMAGE . \Request\SyRequest::getParams('session_id');
        \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->set($redisKey, strtoupper($code), 190);

        $this->SyResult->setData([
            'image' => 'data:image/png;base64,' . base64_encode($imageContent),
        ]);
        $this->sendRsp();
    }

    /**
     * 上传图片
     * @SyFilter-{"field": "upload_type","explain": "上传类型","type": "int","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "image_base64","explain": "图片base64内容","type": "string","rules": {"baseimage": 1}}
     * @SyFilter-{"field": "image_url","explain": "图片链接","type": "string","rules": {"url": 1}}
     * @SyFilter-{"field": "image_wxmedia","explain": "微信媒体ID","type": "string","rules": {"min": 1}}
     */
    public function uploadImageAction()
    {
        //思想-不管何种方式的图片上传,都转换成base64编码传递给services服务
        //上传类型 1:文件上传 2:base64上传 3:url上传 4:微信媒体上传
        $uploadType = (int)\Request\SyRequest::getParams('upload_type');
        $handleRes = \Dao\ApiImageDao::uploadImageHandle($uploadType);
        $uploadRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/Image/uploadImage', $handleRes);
        $this->sendRsp($uploadRes);
    }
}
