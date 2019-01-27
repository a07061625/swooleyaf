<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-27
 * Time: 上午10:08
 */
namespace DingDing;

use Constant\ErrorCode;
use Exception\DingDing\TalkException;

abstract class TalkBaseCorp extends TalkBase {
    const ACCESS_TOKEN_TYPE_CORP = 1; //令牌类型-企业
    const ACCESS_TOKEN_TYPE_PROVIDER = 2; //令牌类型-服务商

    private static $totalAccessTokenType = [
        self::ACCESS_TOKEN_TYPE_CORP => '企业',
        self::ACCESS_TOKEN_TYPE_PROVIDER => '服务商',
    ];

    /**
     * 令牌类型
     * @var int
     */
    protected $_tokenType = 0;
    /**
     * 企业ID
     * @var string
     */
    protected $_corpId = '';
    /**
     * 应用标识
     * @var string
     */
    protected $_agentTag = '';

    public function __construct(){
        parent::__construct();
        $this->_tokenType = self::ACCESS_TOKEN_TYPE_CORP;
    }

    /**
     * @param int $accessTokenType
     * @throws \Exception\DingDing\TalkException
     */
    public function setAccessTokenType(int $accessTokenType){
        if(isset(self::$totalAccessTokenType[$accessTokenType])){
            $this->_tokenType = $accessTokenType;
        } else {
            throw new TalkException('令牌类型不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }
}