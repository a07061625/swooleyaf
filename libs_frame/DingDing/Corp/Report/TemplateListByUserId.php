<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-31
 * Time: 下午3:11
 */
namespace DingDing\Corp\Report;

use Constant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use DingDing\TalkUtilBase;
use Exception\DingDing\TalkException;
use Tool\Tool;

/**
 * 获取用户可见的日志模板
 * @package DingDing\Corp\Report
 */
class TemplateListByUserId extends TalkBaseCorp {
    use TalkTraitCorp;

    /**
     * 用户ID
     * @var string
     */
    private $userid = '';
    /**
     * 偏移量
     * @var int
     */
    private $offset = 0;
    /**
     * 分页大小
     * @var int
     */
    private $size = 0;

    public function __construct(string $corpId,string $agentTag){
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['offset'] = 0;
        $this->reqData['size'] = 10;
    }

    private function __clone(){
    }

    /**
     * @param string $userId
     * @throws \Exception\DingDing\TalkException
     */
    public function setUserId(string $userId){
        if(ctype_alnum($userId)){
            $this->reqData['userid'] = $userId;
        } else {
            throw new TalkException('用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $offset
     * @throws \Exception\DingDing\TalkException
     */
    public function setOffset(int $offset){
        if($offset >= 0){
            $this->reqData['offset'] = $offset;
        } else {
            throw new TalkException('偏移量不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $size
     * @throws \Exception\DingDing\TalkException
     */
    public function setSize(int $size){
        if($size > 0){
            $this->reqData['size'] = $size > 100 ? 100 : $size;
        } else {
            throw new TalkException('分页大小不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/report/template/listbyuserid?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = TalkUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if($sendData['errcode'] == 0){
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::DING_TALK_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}