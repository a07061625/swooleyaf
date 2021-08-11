<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getGroupId()
 * @method string getSceneId()
 * @method string getExperimentId()
 * @method string getAppGroupIdentity()
 */
class ListABTestFixedFlowDividers extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/scenes/[sceneId]/groups/[groupId]/experiments/[experimentId]/fixed-flow-dividers';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->pathParameters['groupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSceneId($value)
    {
        $this->data['SceneId'] = $value;
        $this->pathParameters['sceneId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExperimentId($value)
    {
        $this->data['ExperimentId'] = $value;
        $this->pathParameters['experimentId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppGroupIdentity($value)
    {
        $this->data['AppGroupIdentity'] = $value;
        $this->pathParameters['appGroupIdentity'] = $value;

        return $this;
    }
}
