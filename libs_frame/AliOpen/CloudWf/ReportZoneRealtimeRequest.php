<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ReportZoneRealtime
 *
 * @method string getAgsid()
 */
class ReportZoneRealtimeRequest extends RpcAcsRequest
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
            'ReportZoneRealtime',
            'cloudwf'
        );
    }

    /**
     * @param string $agsid
     *
     * @return $this
     */
    public function setAgsid($agsid)
    {
        $this->requestParameters['Agsid'] = $agsid;
        $this->queryParameters['Agsid'] = $agsid;

        return $this;
    }
}
