<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getRequestId()
 * @method $this withRequestId($value)
 * @method string getMainUserId()
 * @method $this withMainUserId($value)
 * @method array getEcsDescList()
 * @method string getCallerUid()
 * @method $this withCallerUid($value)
 */
class SubmitInfo extends Rpc
{
    /**
     * @return $this
     */
    public function withEcsDescList(array $ecsDescList)
    {
        $this->data['EcsDescList'] = $ecsDescList;
        foreach ($ecsDescList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ResourceId'])) {
                $this->options['form_params']['EcsDescList.' . ($depth1 + 1) . '.ResourceId'] = $depth1Value['ResourceId'];
            }
            if (isset($depth1Value['BussinessDesc'])) {
                $this->options['form_params']['EcsDescList.' . ($depth1 + 1) . '.BussinessDesc'] = $depth1Value['BussinessDesc'];
            }
            if (isset($depth1Value['MiddleWareDesc'])) {
                $this->options['form_params']['EcsDescList.' . ($depth1 + 1) . '.MiddleWareDesc'] = $depth1Value['MiddleWareDesc'];
            }
            if (isset($depth1Value['OtherMiddleWareDesc'])) {
                $this->options['form_params']['EcsDescList.' . ($depth1 + 1) . '.OtherMiddleWareDesc'] = $depth1Value['OtherMiddleWareDesc'];
            }
            if (isset($depth1Value['BussinessType'])) {
                $this->options['form_params']['EcsDescList.' . ($depth1 + 1) . '.BussinessType'] = $depth1Value['BussinessType'];
            }
            if (isset($depth1Value['AppType'])) {
                $this->options['form_params']['EcsDescList.' . ($depth1 + 1) . '.AppType'] = $depth1Value['AppType'];
            }
            if (isset($depth1Value['EnvType'])) {
                $this->options['form_params']['EcsDescList.' . ($depth1 + 1) . '.EnvType'] = $depth1Value['EnvType'];
            }
            if (isset($depth1Value['UserId'])) {
                $this->options['form_params']['EcsDescList.' . ($depth1 + 1) . '.UserId'] = $depth1Value['UserId'];
            }
        }

        return $this;
    }
}
