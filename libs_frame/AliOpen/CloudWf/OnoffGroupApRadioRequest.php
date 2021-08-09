<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of OnoffGroupApRadio
 *
 * @method string getApgroupId()
 * @method string getDisabled()
 */
class OnoffGroupApRadioRequest extends RpcAcsRequest
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
            'cloudwf',
            '2017-03-28',
            'OnoffGroupApRadio',
            'cloudwf'
        );
    }

    /**
     * @param string $apgroupId
     *
     * @return $this
     */
    public function setApgroupId($apgroupId)
    {
        $this->requestParameters['ApgroupId'] = $apgroupId;
        $this->queryParameters['ApgroupId'] = $apgroupId;

        return $this;
    }

    /**
     * @param string $disabled
     *
     * @return $this
     */
    public function setDisabled($disabled)
    {
        $this->requestParameters['Disabled'] = $disabled;
        $this->queryParameters['Disabled'] = $disabled;

        return $this;
    }
}
