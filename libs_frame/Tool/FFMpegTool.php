<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/8/2 0002
 * Time: 18:56
 */
namespace Tool;

use Constant\ErrorCode;
use Exception\Common\CheckException;
use Traits\SimpleTrait;

class FFMpegTool {
    use SimpleTrait;

    /**
     * 执行命令
     * @param string $params 命令参数
     * @param string $command 命令
     * @throws \Exception\Common\CheckException
     */
    public static function execCommand(string $params,string $command=''){
        if(strlen($params) == 0){
            throw new CheckException('参数不能为空', ErrorCode::FFMPEG_PARAM_ERROR);
        }

        $output = [];
        $execStatus = 0;
        $trueCommand = strlen($command) == 0 ? 'ffmpeg' : $command;
        $trueCommand .= ' ' . $params;
        exec($trueCommand, $output, $execStatus);
        if($execStatus == -1){
            throw new CheckException('执行出错', ErrorCode::FFMPEG_EXEC_ERROR);
        }
    }
}