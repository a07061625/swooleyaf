<?php

namespace AliOpen\Ivision;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateTrainDataTag
 *
 * @method string getProjectId()
 * @method string getShowLog()
 * @method string getTagItems()
 * @method string getOwnerId()
 * @method string getDataId()
 */
class CreateTrainDataTagRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ivision', '2019-03-08', 'CreateTrainDataTag', 'ivision');
    }

    /**
     * @param string $projectId
     *
     * @return $this
     */
    public function setProjectId($projectId)
    {
        $this->requestParameters['ProjectId'] = $projectId;
        $this->queryParameters['ProjectId'] = $projectId;

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
     * @param string $tagItems
     *
     * @return $this
     */
    public function setTagItems($tagItems)
    {
        $this->requestParameters['TagItems'] = $tagItems;
        $this->queryParameters['TagItems'] = $tagItems;

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

    /**
     * @param string $dataId
     *
     * @return $this
     */
    public function setDataId($dataId)
    {
        $this->requestParameters['DataId'] = $dataId;
        $this->queryParameters['DataId'] = $dataId;

        return $this;
    }
}
