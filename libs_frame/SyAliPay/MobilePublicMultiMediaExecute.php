<?php

namespace SyAliPay;

/**
 * 多媒体文件客户端
 *
 * @author yuanwai.wang
 *
 * @version $Id: SyAliPay\AlipayMobilePublicMultiMediaExecute.php, v 0.1 Aug 15, 2014 10:19:01 AM yuanwai.wang Exp $
 */
class MobilePublicMultiMediaExecute
{
    private $code = 200;
    private $msg = '';
    private $body = '';
    private $params = '';
    private $fileSuffix = [
        'image/jpeg' => 'jpg',
        'text/plain' => 'text',
    ];

    // @$header : 头部
    public function __construct($header, $body, $httpCode)
    {
        $this->code = $httpCode;
        $this->msg = '';
        $this->params = $header;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return string
     */
    public function getType()
    {
        $subject = $this->params;
        $pattern = '/Content\-Type:([^;]+)/';
        preg_match($pattern, $subject, $matches);
        if ($matches) {
            $type = $matches[1];
        } else {
            $type = 'application/download';
        }

        return str_replace(' ', '', $type);
    }

    /**
     * @return int
     */
    public function getContentLength()
    {
        $subject = $this->params;
        $pattern = '/Content-Length:\s*([^\n]+)/';
        preg_match($pattern, $subject, $matches);

        return (int)($matches[1] ?? '');
    }

    public function getFileSuffix($fileType)
    {
        $type = $this->fileSuffix[$fileType] ?? 'text/plain';
        if (!$type) {
            $type = 'json';
        }

        return $type;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        //header('Content-type: image/jpeg');
        return $this->body;
    }

    /**
     * 获取参数
     *
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }
}
