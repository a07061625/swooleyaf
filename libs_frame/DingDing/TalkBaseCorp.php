<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-27
 * Time: 上午10:08
 */
namespace DingDing;

use SyConstant\ErrorCode;
use SyException\DingDing\TalkException;

abstract class TalkBaseCorp extends TalkBase
{
    const ACCESS_TOKEN_TYPE_CORP = 1; //令牌类型-企业
    const ACCESS_TOKEN_TYPE_PROVIDER = 2; //令牌类型-服务商
    const MESSAGE_TYPE_TEXT = 'text';
    const MESSAGE_TYPE_IMAGE = 'image';
    const MESSAGE_TYPE_VOICE = 'voice';
    const MESSAGE_TYPE_FILE = 'file';
    const MESSAGE_TYPE_LINK = 'link';
    const MESSAGE_TYPE_OA = 'oa';
    const MESSAGE_TYPE_MARKDOWN = 'markdown';
    const MESSAGE_TYPE_ACTION_CARD = 'action_card';
    const MEDIA_TYPE_IMAGE = 'image';
    const MEDIA_TYPE_VOICE = 'voice';
    const MEDIA_TYPE_FILE = 'file';

    protected static $totalMessageType = [
        self::MESSAGE_TYPE_TEXT => '文本',
        self::MESSAGE_TYPE_IMAGE => '图片',
        self::MESSAGE_TYPE_VOICE => '语音',
        self::MESSAGE_TYPE_FILE => '文件',
        self::MESSAGE_TYPE_LINK => '链接',
        self::MESSAGE_TYPE_OA => 'OA',
        self::MESSAGE_TYPE_MARKDOWN => 'markdown',
        self::MESSAGE_TYPE_ACTION_CARD => '卡片',
    ];
    protected static $totalMediaType = [
        self::MEDIA_TYPE_IMAGE => '图片',
        self::MEDIA_TYPE_VOICE => '语音',
        self::MEDIA_TYPE_FILE => '文件',
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
     * @throws \SyException\DingDing\TalkException
     */
    public function setAccessTokenType(int $accessTokenType)
    {
        if (isset(self::$totalAccessTokenType[$accessTokenType])) {
            $this->_tokenType = $accessTokenType;
        } else {
            throw new TalkException('令牌类型不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }
}
