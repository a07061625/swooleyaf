<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 9:10
 */
namespace Wx;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;

abstract class WxBaseCorp extends WxBase
{
    const ACCESS_TOKEN_TYPE_CORP = 1; //令牌类型-企业
    const ACCESS_TOKEN_TYPE_PROVIDER = 2; //令牌类型-服务商
    const INVOICE_REIMBURSE_STATUS_INIT = 'INVOICE_REIMBURSE_INIT'; //发票报销状态-未锁定
    const INVOICE_REIMBURSE_STATUS_LOCK = 'INVOICE_REIMBURSE_LOCK'; //发票报销状态-已锁定
    const INVOICE_REIMBURSE_STATUS_CLOSURE = 'INVOICE_REIMBURSE_CLOSURE'; //发票报销状态-已核销
    const MESSAGE_TYPE_NEWS = 'news'; //消息类型-图文
    const MESSAGE_TYPE_MPNEWS = 'mpnews'; //消息类型-图文
    const MESSAGE_TYPE_TEXT = 'text'; //消息类型-文本
    const MESSAGE_TYPE_VOICE = 'voice'; //消息类型-语音
    const MESSAGE_TYPE_IMAGE = 'image'; //消息类型-图片
    const MESSAGE_TYPE_VIDEO = 'video'; //消息类型-视频
    const MESSAGE_TYPE_FILE = 'file'; //消息类型-文件
    const MESSAGE_TYPE_TEXTCARD = 'textcard'; //消息类型-文本卡片
    const MESSAGE_TYPE_MARKDOWN = 'markdown'; //消息类型-markdown
    const MESSAGE_TYPE_MINI_NOTICE = 'miniprogram_notice'; //消息类型-小程序通知
    protected static $totalInvoiceReimburseStatus = [
        self::INVOICE_REIMBURSE_STATUS_INIT => '未锁定',
        self::INVOICE_REIMBURSE_STATUS_LOCK => '已锁定',
        self::INVOICE_REIMBURSE_STATUS_CLOSURE => '已核销',
    ];
    protected static $totalMessageType = [
        self::MESSAGE_TYPE_NEWS => '图文',
        self::MESSAGE_TYPE_MPNEWS => '图文',
        self::MESSAGE_TYPE_TEXT => '文本',
        self::MESSAGE_TYPE_VOICE => '语音',
        self::MESSAGE_TYPE_IMAGE => '图片',
        self::MESSAGE_TYPE_VIDEO => '视频',
        self::MESSAGE_TYPE_FILE => '文件',
        self::MESSAGE_TYPE_TEXTCARD => '文本卡片',
        self::MESSAGE_TYPE_MARKDOWN => 'markdown',
        self::MESSAGE_TYPE_MINI_NOTICE => '小程序通知',
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

    private static $totalAccessTokenType = [
        self::ACCESS_TOKEN_TYPE_CORP => '企业',
        self::ACCESS_TOKEN_TYPE_PROVIDER => '服务商',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->_tokenType = self::ACCESS_TOKEN_TYPE_CORP;
    }

    /**
     * @param int $accessTokenType
     * @throws \SyException\Wx\WxException
     */
    public function setAccessTokenType(int $accessTokenType)
    {
        if (isset(self::$totalAccessTokenType[$accessTokenType])) {
            $this->_tokenType = $accessTokenType;
        } else {
            throw new WxException('令牌类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }
}
