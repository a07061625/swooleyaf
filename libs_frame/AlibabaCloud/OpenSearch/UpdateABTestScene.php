<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getSceneId()
 * @method string getAppGroupIdentity()
 */
class UpdateABTestScene extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/scenes/[sceneId]';

    /** @var string */
    public $method = 'PUT';

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
    public function withAppGroupIdentity($value)
    {
        $this->data['AppGroupIdentity'] = $value;
        $this->pathParameters['appGroupIdentity'] = $value;

        return $this;
    }
}
