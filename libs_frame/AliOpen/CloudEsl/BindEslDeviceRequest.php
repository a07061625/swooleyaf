<?php

namespace AliOpen\CloudEsl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of BindEslDevice
 *
 * @method string getEslBarCode()
 * @method string getStoreId()
 * @method string getItemBarCode()
 */
class BindEslDeviceRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'cloudesl',
            '2018-08-01',
            'BindEslDevice'
        );
    }

    /**
     * @param string $eslBarCode
     *
     * @return $this
     */
    public function setEslBarCode($eslBarCode)
    {
        $this->requestParameters['EslBarCode'] = $eslBarCode;
        $this->queryParameters['EslBarCode'] = $eslBarCode;

        return $this;
    }

    /**
     * @param string $storeId
     *
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->requestParameters['StoreId'] = $storeId;
        $this->queryParameters['StoreId'] = $storeId;

        return $this;
    }

    /**
     * @param string $itemBarCode
     *
     * @return $this
     */
    public function setItemBarCode($itemBarCode)
    {
        $this->requestParameters['ItemBarCode'] = $itemBarCode;
        $this->queryParameters['ItemBarCode'] = $itemBarCode;

        return $this;
    }
}
