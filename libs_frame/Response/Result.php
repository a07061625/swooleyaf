<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 11:01
 */
namespace Response;

use SyConstant\ErrorCode;
use SyServer\BaseServer;
use SyTool\Tool;

class Result
{
    private $result = [];

    public function __construct()
    {
        $this->result = [
            'req_id' => BaseServer::getReqId(),
            'code' => ErrorCode::COMMON_SUCCESS,
            'msg' => '',
            'data' => []
        ];
    }

    private function __clone()
    {
    }

    public function __toString()
    {
        return $this->getJson();
    }

    public function getJson()
    {
        if (is_array($this->result)) {
            $this->result['_nowtime'] = Tool::getNowTime();
            return Tool::jsonEncode($this->result);
        }

        return false;
    }

    public function set($key, $value)
    {
        $this->result[$key] = $value;
    }

    public function setAll(array $data)
    {
        $this->result = $data;
    }

    public function getResult() : array
    {
        return $this->result;
    }

    public function setData($data)
    {
        $this->result['data'] = $data;
    }

    public function getData()
    {
        return $this->result['data'];
    }

    public function setMsg(string $msg)
    {
        $this->result['msg'] = $msg;
    }

    public function getMsg()
    {
        return $this->result['msg'];
    }

    public function setCode(int $code)
    {
        $this->result['code'] = $code;
    }

    public function getCode()
    {
        return $this->result['code'];
    }

    public function setCodeMsg(int $code, string $msg)
    {
        $this->setCode($code);
        $this->setMsg($msg);
    }

    public function setSysError(int $code, string $msg = '')
    {
        $this->setCode($code);

        if (strlen($msg) > 0) {
            $this->setMsg($msg);
        } else {
            $this->setMsg(ErrorCode::getMsg($code));
        }
    }
}
