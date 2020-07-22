<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/7 0007
 * Time: 16:13
 */
namespace SyResponse;

use yii\web\Response;

class SyResp2 extends Response
{
    /**
     * @var \Swoole\Http\Response
     */
    private $_swResponse;

    public function setSwResponse($response)
    {
        $this->_swResponse = $response;
    }

    public function getSwResponse()
    {
        return $this->_swResponse;
    }

    // 改写底层发送头信息
    public function sendHeaders()
    {
        if (is_null($this->_swResponse)) {
            return;
        }

        $headers = $this->getHeaders();
        if ($headers->count > 0) {
            foreach ($headers as $name => $values) {
                $name = str_replace(' ', '-', ucwords(str_replace('-', ' ', $name)));
                foreach ($values as $value) {
                    // 这里需要使用sw response来发送头信息
                    $this->_swResponse->header($name, $value);
                }
            }
        }
        // 这里需要使用sw response来发送状态码
        $this->_swResponse->status($this->getStatusCode());
    }

    // 改写底层发送内容
    public function sendContent()
    {
        if (is_null($this->_swResponse)) {
            return;
        }

        if ($this->stream === null) {
            if ($this->content) {
                // 这里需要使用sw response来输出
                $this->_swResponse->end($this->content);
            } else {
                $this->_swResponse->end();
            }
            return;
        }

        $chunkSize = 2097152; // 2MB per chunk swoole limit
        if (is_array($this->stream)) {
            list($handle, $begin, $end) = $this->stream;
            fseek($handle, $begin);
            while (!feof($handle) && ($pos = ftell($handle)) <= $end) {
                if ($pos + $chunkSize > $end) {
                    $chunkSize = $end - $pos + 1;
                }
                // 使用sw response对象来输出
                $this->_swResponse->write(fread($handle, $chunkSize));
                flush();
            }
            fclose($handle);
        } else {
            while (!feof($this->stream)) {
                $this->_swResponse->write(fread($this->stream, $chunkSize));
                flush();
            }
            fclose($this->stream);
        }
        // 使用sw response对象来输出
        $this->_swResponse->end();
    }
}
