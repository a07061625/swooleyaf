<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getSceneId()
 */
class EnableExperiment extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/scenes/[sceneId]/actions/enable-experiment';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->pathParameters['instanceId'] = $value;

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
}
