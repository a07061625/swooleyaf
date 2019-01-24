<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

class VirtualMFADeviceDeleteRequest extends RpcAcsRequest {
    private $serialNumber;

    public function __construct(){
        parent::__construct("Ram", "2015-05-01", "DeleteVirtualMFADevice");
        $this->setProtocol("https");
        $this->setMethod("POST");
    }

    public function getSerialNumber(){
        return $this->serialNumber;
    }

    public function setSerialNumber($serialNumber){
        $this->serialNumber = $serialNumber;
        $this->queryParameters["SerialNumber"] = $serialNumber;
    }
}