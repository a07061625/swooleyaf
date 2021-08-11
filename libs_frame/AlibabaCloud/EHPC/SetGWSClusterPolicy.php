<?php

namespace AlibabaCloud\EHPC;

/**
 * @method string getWatermark()
 * @method $this withWatermark($value)
 * @method string getLocalDrive()
 * @method $this withLocalDrive($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getClipboard()
 * @method $this withClipboard($value)
 * @method string getUsbRedirect()
 * @method $this withUsbRedirect($value)
 * @method string getAsyncMode()
 * @method $this withAsyncMode($value)
 * @method string getUdpPort()
 * @method $this withUdpPort($value)
 */
class SetGWSClusterPolicy extends Rpc
{
    /** @var string */
    public $method = 'POST';
}
