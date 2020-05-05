<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteVirtualMFADevice
 * @method string getSerialNumber()
 */
class VirtualMFADeviceDeleteRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Ram', '2015-05-01', 'DeleteVirtualMFADevice', 'ram');
    }

    /**
     * @param string $serialNumber
     * @return $this
     */
    public function setSerialNumber($serialNumber)
    {
        $this->requestParameters['SerialNumber'] = $serialNumber;
        $this->queryParameters['SerialNumber'] = $serialNumber;

        return $this;
    }
}
