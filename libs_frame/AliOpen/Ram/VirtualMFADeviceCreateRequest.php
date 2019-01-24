<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class VirtualMFADeviceCreateRequest extends RpcAcsRequest {
    private $virtualMFADeviceName;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "CreateVirtualMFADevice");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getVirtualMFADeviceName(){
        return $this->virtualMFADeviceName;
    }

    public function setVirtualMFADeviceName($virtualMFADeviceName){
        $this->virtualMFADeviceName = $virtualMFADeviceName;
        $this->queryParameters["VirtualMFADeviceName"] = $virtualMFADeviceName;
    }
}