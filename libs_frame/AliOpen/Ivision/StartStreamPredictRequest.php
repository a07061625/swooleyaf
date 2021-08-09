<?php

namespace AliOpen\Ivision;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of StartStreamPredict
 *
 * @method string getPredictId()
 * @method string getShowLog()
 * @method string getOwnerId()
 */
class StartStreamPredictRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ivision', '2019-03-08', 'StartStreamPredict', 'ivision');
    }

    /**
     * @param string $predictId
     *
     * @return $this
     */
    public function setPredictId($predictId)
    {
        $this->requestParameters['PredictId'] = $predictId;
        $this->queryParameters['PredictId'] = $predictId;

        return $this;
    }

    /**
     * @param string $showLog
     *
     * @return $this
     */
    public function setShowLog($showLog)
    {
        $this->requestParameters['ShowLog'] = $showLog;
        $this->queryParameters['ShowLog'] = $showLog;

        return $this;
    }

    /**
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
