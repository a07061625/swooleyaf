<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/30 0030
 * Time: 19:00
 */
namespace Dao;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\Common\CheckException;
use Log\Log;
use Request\SyRequest;
use SyModule\SyModuleService;
use Tool\Tool;
use Traits\SimpleDaoTrait;

class ApiImageDao {
    use SimpleDaoTrait;

    private static $imageMaxSize = 5242880;
    private static $uploadImageMap = [
        1 => 'uploadImageFile',
        2 => 'uploadImageBase64',
        3 => 'uploadImageUrl',
        4 => 'uploadImageWxMedia',
    ];
    private static $indexUeditorMap = [
        'config' => 'indexUeditorConfig',
        'uploadimage' => 'indexUeditorUploadImage',
    ];

    private static function uploadImageFile() {
        $file = empty($_FILES) ? [] : current($_FILES);
        if(empty($file)){
            throw new CheckException('没有上传图片文件', ErrorCode::COMMON_PARAM_ERROR);
        } else if($file['error'] > 0){
            Log::error('上传文件出错,错误码为:' . $file['error']);
            throw new CheckException('上传文件出错', ErrorCode::COMMON_PARAM_ERROR);
        } else if ($file['size'] > self::$imageMaxSize) {
            throw new CheckException('图片内容大小不能超过5M', ErrorCode::COMMON_PARAM_ERROR);
        }

        $resArr = SyRequest::getParams();
        $resArr['_syfile_name'] = $file['name'];
        $resArr['_syfile_content'] = file_get_contents($file['tmp_name']);

        return $resArr;
    }

    private static function uploadImageBase64() {
        $imageBase64 = (string)SyRequest::getParams('image_base64', '');
        if(strlen($imageBase64) == 0){
            throw new CheckException('图片base64内容不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        $base64Result = [];
        preg_match('/^(data\:image\/([A-Za-z]{3,4})\;base64\,)/', $imageBase64, $base64Result);
        $content = base64_decode(str_replace($base64Result[1], '', $imageBase64));
        unset($base64Result);
        if ($content === false) {
            throw new CheckException('图片base64内容不合法', ErrorCode::COMMON_PARAM_ERROR);
        }

        $resArr = SyRequest::getParams();
        $resArr['_syfile_name'] = '';
        $resArr['_syfile_content'] = $content;
        return $resArr;
    }

    private static function uploadImageUrl() {
        $imageUrl = (string)SyRequest::getParams('image_url', '');
        if(strlen($imageUrl) == 0){
            throw new CheckException('图片链接不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        $imageInfo = getimagesize($imageUrl);
        if($imageInfo === false){
            throw new CheckException('获取图片失败', ErrorCode::COMMON_PARAM_ERROR);
        } else if(!in_array($imageInfo[2], [1, 2, 3])){
            throw new CheckException('图片类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $resArr = SyRequest::getParams();
        $resArr['_syfile_name'] = $imageUrl;
        $resArr['_syfile_content'] = file_get_contents($imageUrl);
        return $resArr;
    }

    private static function uploadImageWxMedia() {
        $mediaId = (string)SyRequest::getParams('image_wxmedia', '');
        if(strlen($mediaId) == 0){
            throw new CheckException('微信媒体ID不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        //下载微信媒体到服务器
        $mediaFile = SY_ROOT . '/static/8.jpg';
        $resArr = SyRequest::getParams();
        $resArr['_syfile_name'] = $mediaId;
        $resArr['_syfile_content'] = file_get_contents($mediaFile);
        unlink($mediaFile);

        return $resArr;
    }

    /**
     * 处理图片上传
     * @param int $uploadType
     * @return array
     * @throws \Exception\Common\CheckException
     */
    public static function uploadImageHandle(int $uploadType){
        $funcName = Tool::getArrayVal(self::$uploadImageMap, $uploadType, null);
        if(is_null($funcName)){
            throw new CheckException('上传类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $handleRes = self::$funcName();
        $contentLength = $handleRes['_syfile_content'] !== false ? strlen($handleRes['_syfile_content']) : 0;
        if ($contentLength == 0) {
            throw new CheckException('获取图片内容失败', ErrorCode::COMMON_PARAM_ERROR);
        } else if ($contentLength > self::$imageMaxSize) {
            throw new CheckException('图片内容大小不能超过5M', ErrorCode::COMMON_PARAM_ERROR);
        }

        $cacheTag = Tool::getNowTime() . Tool::createNonceStr(6);
        if (CacheSimpleFactory::getRedisInstance()->set(Project::REDIS_PREFIX_IMAGE_DATA . $cacheTag, $handleRes['_syfile_content'], 1800)) {
            unset($handleRes['_syfile_content']);
            $handleRes['_syfile_tag'] = $cacheTag;

            return $handleRes;
        } else {
            throw new CheckException('添加图片内容缓存失败', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    private static function indexUeditorUploadImage() {
        $handleRes = self::uploadImageHandle(1);
        $uploadRes = SyModuleService::getInstance()->sendApiReq('/Index/Image/uploadImage', $handleRes);
        $uploadData = Tool::jsonDecode($uploadRes);
        if(!is_array($uploadData)){
            return [
                'rid' => 0,
                'message' => '上传图片出错',
            ];
        } else if($uploadData['code'] > 0){
            return [
                'rid' => 0,
                'message' => $uploadData['msg'],
            ];
        } else {
            $editorRes = $uploadData['data'];
            $editorRes['state'] = 'SUCCESS';
            $editorRes['url'] = $uploadData['data']['image_url'];
            unset($editorRes['image_url']);
            return $editorRes;
        }
    }

    private static function indexUeditorConfig() {
        $callback = trim(SyRequest::getParams('callback', ''));
        if(strlen($callback) > 0){
            return $callback . '(' . Tool::jsonEncode(Tool::getConfig('ueditor.' . SY_ENV . SY_PROJECT)) . ')';
        } else {
            throw new CheckException('回调函数名不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    public static function indexUeditorHandle(string $actionType){
        $funcName = Tool::getArrayVal(self::$indexUeditorMap, $actionType, null);
        if(is_null($funcName)){
            throw new CheckException('动作类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        return self::$funcName();
    }
}