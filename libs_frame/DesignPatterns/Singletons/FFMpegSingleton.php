<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/5/30 0030
 * Time: 14:56
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class FFMpegSingleton
{
    use SingletonTrait;

    private $commandName = '';

    private function __construct()
    {
        $configs = Tool::getConfig('av.' . SY_ENV . SY_PROJECT . '.ffmpeg');
        $this->commandName = (string)Tool::getArrayVal($configs, 'command.name', 'ffmpeg', true);
    }

    /**
     * @return \DesignPatterns\Singletons\FFMpegSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 执行命令
     * @param array $params 参数数组
     * @return array
     * @throws \SyException\Common\CheckException
     */
    public function execCommand(array $params)
    {
        if (empty($params)) {
            throw new CheckException('参数不能为空', ErrorCode::FFMPEG_PARAM_ERROR);
        }

        $command = $this->commandName . ' ' . implode(' ', $params);
        return Tool::execSystemCommand($command);
    }
}
