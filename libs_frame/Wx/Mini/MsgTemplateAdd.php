<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 18:09
 */
namespace Wx\Mini;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilBase;
use Wx\WxUtilBaseAlone;
use Wx\WxUtilOpenBase;

class MsgTemplateAdd extends WxBaseMini {
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 标题ID
     * @var string
     */
    private $titleId = '';
    /**
     * 关键词ID列表
     * @var array
     */
    private $keywordIds = [];
    /**
     * 平台类型
     * @var string
     */
    private $platType = '';

    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/wxopen/template/add?access_token=';
        $this->appId = $appId;
        $this->platType = WxUtilBase::PLAT_TYPE_MINI;
    }

    public function __clone(){
    }

    /**
     * @param string $titleId
     * @throws \Exception\Wx\WxException
     */
    public function setTitleId(string $titleId){
        if(strlen($titleId) > 0){
            $this->reqData['id'] = $titleId;
        } else {
            throw new WxException('标题ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $keywordIds
     * @throws \Exception\Wx\WxException
     */
    public function setKeywordIds(array $keywordIds){
        if(count($keywordIds) > 10){
            throw new WxException('关键词ID不能超过10个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->keywordIds = [];
        foreach ($keywordIds as $keywordId) {
            if(is_numeric($keywordId) && ($keywordId >= 1)){
                $trueKeywordId = (int)$keywordId;
                $this->keywordIds[$trueKeywordId] = 1;
            }
        }
    }

    /**
     * @param int $keywordId
     * @throws \Exception\Wx\WxException
     */
    public function addKeywordId(int $keywordId){
        if($keywordId <= 0){
            throw new WxException('关键词ID不合法', ErrorCode::WX_PARAM_ERROR);
        } else if(count($this->keywordIds) >= 10){
            throw new WxException('关键词ID不能超过10个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->keywordIds[$keywordId] = 1;
    }

    /**
     * @param string $platType
     * @throws \Exception\Wx\WxException
     */
    public function setPlatType(string $platType) {
        if(in_array($platType, [WxUtilBase::PLAT_TYPE_MINI, WxUtilBase::PLAT_TYPE_OPEN_MINI])){
            $this->platType = $platType;
        } else {
            throw new WxException('平台类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['id'])){
            throw new WxException('标题ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['keyword_id_list'] = array_keys($this->keywordIds);

        $resArr = [
            'code' => 0
        ];

        if($this->platType == WxUtilBase::PLAT_TYPE_MINI){
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilBaseAlone::getAccessToken($this->appId);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if(isset($sendData['template_id'])){
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}