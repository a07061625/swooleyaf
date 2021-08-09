<?php

namespace AliOpen\Crm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of BatchGetAliyunIdByAliyunPk
 *
 * @method array getPkLists()
 */
class BatchGetAliyunIdByAliyunPkRequest extends RpcAcsRequest
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
            'Crm',
            '2015-04-08',
            'BatchGetAliyunIdByAliyunPk',
            'crm'
        );
    }

    /**
     * @return $this
     */
    public function setPkLists(array $pkLists)
    {
        $this->requestParameters['PkLists'] = $pkLists;
        foreach ($pkLists as $i => $iValue) {
            $this->queryParameters['PkList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
