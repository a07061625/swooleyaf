<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 9:10
 */
namespace Wx;

use Constant\ErrorCode;
use Exception\Wx\WxException;

abstract class WxBaseCorp extends WxBase {
    const ACCESS_TOKEN_TYPE_CORP = 1; //令牌类型-企业
    const ACCESS_TOKEN_TYPE_PROVIDER = 2; //令牌类型-服务商
    const INVOICE_REIMBURSE_STATUS_INIT = 'INVOICE_REIMBURSE_INIT'; //发票报销状态-未锁定
    const INVOICE_REIMBURSE_STATUS_LOCK = 'INVOICE_REIMBURSE_LOCK'; //发票报销状态-已锁定
    const INVOICE_REIMBURSE_STATUS_CLOSURE = 'INVOICE_REIMBURSE_CLOSURE'; //发票报销状态-已核销

    private static $totalAccessTokenType = [
        self::ACCESS_TOKEN_TYPE_CORP => '企业',
        self::ACCESS_TOKEN_TYPE_PROVIDER => '服务商',
    ];
    protected static $totalInvoiceReimburseStatus = [
        self::INVOICE_REIMBURSE_STATUS_INIT => '未锁定',
        self::INVOICE_REIMBURSE_STATUS_LOCK => '已锁定',
        self::INVOICE_REIMBURSE_STATUS_CLOSURE => '已核销',
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
     * @throws \Exception\Wx\WxException
     */
    public function setAccessTokenType(int $accessTokenType){
        if(isset(self::$totalAccessTokenType[$accessTokenType])){
            $this->_tokenType = $accessTokenType;
        } else {
            throw new WxException('令牌类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }
}