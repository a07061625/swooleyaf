<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace SyTrait\Server;

use Response\Result;
use Swoole\Http\Request;
use SyConstant\Project;
use SyTool\Tool;
use Yaf\Request\Http;

trait ProjectHttpTrait
{
    /**
     * 刷新服务令牌到期时间
     */
    public static function refreshServerTokenExpireTime()
    {
        $decryptStr = Tool::decrypt(SY_TOKEN_SECRET, 'f68a600f6c1b1163');
        if (is_bool($decryptStr)) {
            $expireTime = 0;
        } else {
            $expireTime = substr($decryptStr, 0, 8) == SY_TOKEN ? (int)substr($decryptStr, 8) : 0;
        }

        self::$_syServer->set(self::$_serverToken, [
            'token_etime' => $expireTime,
        ]);
    }

    /**
     * 处理应用Http请求
     *
     * @param array                $params
     * @param \Swoole\Http\Request $request
     *
     * @return string
     */
    protected function handleAppReqHttp(array $params, Request $request) : string
    {
        $httpObj = new Http($params['api_uri']);
        $result = $this->_app->bootstrap()->getDispatcher()->dispatch($httpObj)->getBody();
        unset($httpObj);

        return $result;
    }
    private function checkServerHttpTrait()
    {
    }

    private function initTableHttpTrait()
    {
    }

    private function handleReqExceptionByProject(\Throwable $e): Result
    {
    }

    /**
     * 初始化语言类型
     */
    private function initLanguageType()
    {
        if (isset($_COOKIE[Project::DATA_KEY_LANGUAGE_TAG])) {
            $langType = $_COOKIE[Project::DATA_KEY_LANGUAGE_TAG];
        } elseif (isset($_GET[Project::DATA_KEY_LANGUAGE_TAG])) {
            $langType = $_GET[Project::DATA_KEY_LANGUAGE_TAG];
        } else {
            $langType = $_POST[Project::DATA_KEY_LANGUAGE_TAG] ?? '';
        }
        if (isset(Project::$totalLangType[$langType])) {
            $_POST[Project::DATA_KEY_LANGUAGE_TAG] = $langType;
        } else {
            $_POST[Project::DATA_KEY_LANGUAGE_TAG] = Project::LANG_TYPE_DEFAULT;
        }
    }
}
