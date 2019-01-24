<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/7 0007
 * Time: 10:31
 */
namespace SySms\DaYu;

use Constant\ErrorCode;
use DesignPatterns\Singletons\SmsConfigSingleton;
use Exception\Sms\DaYuException;
use SySms\SmsBaseDaYu;

class SmsQuery extends SmsBaseDaYu {
    /**
     * 流水号
     * @var string
     */
    private $bizId = '';
    /**
     * 接收号码
     * @var string
     */
    private $recNum = '';
    /**
     * 发送日期
     * @var string
     */
    private $queryDate = '';
    /**
     * 页码
     * @var int
     */
    private $page = 1;
    /**
     * 每页数量
     * @var int
     */
    private $limit = 10;

    public function __construct(){
        parent::__construct();
        $this->appKey = SmsConfigSingleton::getInstance()->getDaYuConfig()->getAppKey();
        $this->appSecret = SmsConfigSingleton::getInstance()->getDaYuConfig()->getAppSecret();
        $this->reqData['current_page'] = 1;
        $this->reqData['page_size'] = 10;
        $this->setMethod('alibaba.aliqin.fc.sms.num.query');
    }

    private function __clone(){
    }

    /**
     * @param string $bizId
     */
    public function setBizId(string $bizId){
        $trueBizId = trim($bizId);
        if(strlen($trueBizId) > 0){
            $this->reqData['biz_id'] = $trueBizId;
        }
    }

    /**
     * @param string $recNum
     * @throws \Exception\Sms\DaYuException
     */
    public function setRecNum(string $recNum){
        if(ctype_digit($recNum) && (strlen($recNum) == 11) && ($recNum{0} == '1')){
            $this->reqData['rec_num'] = $recNum;
        } else {
            throw new DaYuException('接收号码不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $queryDate
     * @throws \Exception\Sms\DaYuException
     */
    public function setQueryDate(string $queryDate){
        if(strlen($queryDate) == 8){
            $this->reqData['query_date'] = $queryDate;
        } else {
            throw new DaYuException('发送日期不合法', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @param int $page
     * @throws \Exception\Sms\DaYuException
     */
    public function setPage(int $page){
        if($page >= 1){
            $this->reqData['current_page'] = $page;
        } else {
            throw new DaYuException('页码必须大于0', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \Exception\Sms\DaYuException
     */
    public function setLimit(int $limit){
        if(($limit >= 1) && ($limit <= 50)){
            $this->reqData['page_size'] = $limit;
        } else {
            throw new DaYuException('每页数量必须在1-50之间', ErrorCode::SMS_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['rec_num'])){
            throw new DaYuException('接收号码必须填写', ErrorCode::SMS_PARAM_ERROR);
        }
        if(!isset($this->reqData['query_date'])){
            throw new DaYuException('发送日期必须填写', ErrorCode::SMS_PARAM_ERROR);
        }

        return $this->getContent();
    }
}