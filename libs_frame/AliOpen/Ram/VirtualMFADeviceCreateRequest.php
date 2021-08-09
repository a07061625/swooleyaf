<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateVirtualMFADevice
 * @method string getVirtualMFADeviceName()
 */
class VirtualMFADeviceCreateRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'CreateVirtualMFADevice', 'ram');
    }

    /**
     * @param string $virtualMFADeviceName
     * @return $this
     */
    public function setVirtualMFADeviceName($virtualMFADeviceName)
    {
        $this->requestParameters['VirtualMFADeviceName'] = $virtualMFADeviceName;
        $this->queryParameters['VirtualMFADeviceName'] = $virtualMFADeviceName;

        return $this;
    }
}
