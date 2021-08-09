<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of ApgroupBatchDeleteAp
 *
 * @method string getApAssetIds()
 */
class ApgroupBatchDeleteApRequest extends RpcAcsRequest
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
            'ApgroupBatchDeleteAp',
            'cloudwf'
        );
    }

    /**
     * @param string $apAssetIds
     *
     * @return $this
     */
    public function setApAssetIds($apAssetIds)
    {
        $this->requestParameters['ApAssetIds'] = $apAssetIds;
        $this->queryParameters['ApAssetIds'] = $apAssetIds;

        return $this;
    }
}
