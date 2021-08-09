<?php
namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of ListInstanceRegion
 *
 * @method string getLang()
 */
class ListInstanceRegionRequest extends RpcAcsRequest
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
            'cr',
            '2018-12-01',
            'ListInstanceRegion',
            'acr'
        );
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }
}
