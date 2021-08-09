<?php

namespace AliOpen\Foas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ModifyMasterSpec
 *
 * @method string getclusterId()
 * @method string getmasterTargetModel()
 */
class ModifyMasterSpecRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/clusters/[clusterId]/specification';
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('foas', '2018-11-11', 'ModifyMasterSpec', 'foas');
    }

    /**
     * @param string $clusterId
     *
     * @return $this
     */
    public function setclusterId($clusterId)
    {
        $this->requestParameters['clusterId'] = $clusterId;
        $this->pathParameters['clusterId'] = $clusterId;

        return $this;
    }

    /**
     * @param string $masterTargetModel
     *
     * @return $this
     */
    public function setmasterTargetModel($masterTargetModel)
    {
        $this->requestParameters['masterTargetModel'] = $masterTargetModel;
        $this->queryParameters['masterTargetModel'] = $masterTargetModel;

        return $this;
    }
}
