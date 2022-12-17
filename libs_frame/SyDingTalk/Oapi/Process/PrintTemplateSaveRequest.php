<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.process.print.template.save request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.31
 */
class PrintTemplateSaveRequest extends BaseRequest
{
    /**
     * 字体
     */
    private $font;
    /**
     * 是否开启自定义打印
     */
    private $openCustomizePrint;
    /**
     * 审批流程唯一code
     */
    private $processCode;
    /**
     * vm文件
     */
    private $vm;

    public function setFont($font)
    {
        $this->font = $font;
        $this->apiParas['font'] = $font;
    }

    public function getFont()
    {
        return $this->font;
    }

    public function setOpenCustomizePrint($openCustomizePrint)
    {
        $this->openCustomizePrint = $openCustomizePrint;
        $this->apiParas['open_customize_print'] = $openCustomizePrint;
    }

    public function getOpenCustomizePrint()
    {
        return $this->openCustomizePrint;
    }

    public function setProcessCode($processCode)
    {
        $this->processCode = $processCode;
        $this->apiParas['process_code'] = $processCode;
    }

    public function getProcessCode()
    {
        return $this->processCode;
    }

    public function setVm($vm)
    {
        $this->vm = $vm;
        $this->apiParas['vm'] = $vm;
    }

    public function getVm()
    {
        return $this->vm;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.process.print.template.save';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->font, 'font');
        RequestCheckUtil::checkNotNull($this->processCode, 'processCode');
        RequestCheckUtil::checkNotNull($this->vm, 'vm');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
