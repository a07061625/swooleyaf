<?php

namespace AliOpen\Ivision;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateTrainDatasFromUrls
 *
 * @method string getUrls()
 * @method string getProjectId()
 * @method string getShowLog()
 * @method string getTagId()
 * @method string getOwnerId()
 */
class CreateTrainDatasFromUrlsRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ivision', '2019-03-08', 'CreateTrainDatasFromUrls', 'ivision');
    }

    /**
     * @param string $urls
     *
     * @return $this
     */
    public function setUrls($urls)
    {
        $this->requestParameters['Urls'] = $urls;
        $this->queryParameters['Urls'] = $urls;

        return $this;
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
     * @param string $tagId
     *
     * @return $this
     */
    public function setTagId($tagId)
    {
        $this->requestParameters['TagId'] = $tagId;
        $this->queryParameters['TagId'] = $tagId;

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
