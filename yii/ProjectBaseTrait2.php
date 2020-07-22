<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:09
 */
namespace SyTrait\Server;

use Swoole\Server;
use SyRequest\SyReq2;
use SyResponse\SyResp2;
use SyValidator\Validator;
use yii\helpers\ArrayHelper;
use yii\web\Application;
use yii\web\Request;
use yii\web\Response;

trait ProjectBaseTrait2
{
    private function checkServerBaseTrait()
    {
    }

    private function initTableBaseTrait()
    {
    }

    private function addTaskBaseTrait(Server $server)
    {
    }

    /**
     * @param \Swoole\Server $server
     * @param int $taskId
     * @param int $fromId
     * @param array $data
     * @return string 空字符串:执行成功 非空:执行失败
     */
    private function handleTaskBaseTrait(Server $server, int $taskId, int $fromId, array &$data) : string
    {
        return '';
    }

    private function initApp()
    {
        if ($this->_configs['server']['yii']['debug'] > 0) {
            define('YII_DEBUG', true);
        } else {
            define('YII_DEBUG', false);
        }
        define('YII_ENV', SY_ENV);
        define('YII_ENABLE_ERROR_HANDLER', false);

        require_once SY_ROOT . '/vendor/autoload.php';
        require_once SY_ROOT . '/vendor/yiisoft/yii2/Yii.php';
        require_once SY_ROOT . '/common/config/bootstrap.php';
        require_once SY_APP_ROOT . '/config/bootstrap.php';

        $yiiConfig = ArrayHelper::merge(
            require_once SY_ROOT . '/common/config/main.php',
            require_once SY_ROOT . '/common/config/main-local.php',
            require_once SY_APP_ROOT . '/config/main.php',
            require_once SY_APP_ROOT . '/config/main-local.php'
        );

        $yiiConfig['components']['plugin_simple'] = [
            'class' => 'SyFrame\Plugins\SimplePlugin',
        ];
        if (isset($yiiConfig['components']['request'])) {
            $yiiConfig['components']['request']['class'] = SyReq2::class;
        } else {
            $yiiConfig['components']['request'] = [
                'class' => SyReq2::class,
            ];
        }
        if (isset($yiiConfig['components']['response'])) {
            $yiiConfig['components']['response']['class'] = SyResp2::class;
        } else {
            $yiiConfig['components']['response'] = [
                'class' => SyResp2::class,
            ];
        }
        $yiiConfig['bootstrap'][] = 'plugin_simple';
        if (isset($yiiConfig['params'])) {
            $yiiConfig['params']['request_stime'] = 0;
        } else {
            $yiiConfig['params'] = [
                'request_stime' => 0,
            ];
        }

        $this->_app = new Application($yiiConfig);
        Validator::init();
    }
}
