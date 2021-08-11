<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getSelectionRuleId()
 * @method string getInstanceId()
 * @method string getSize()
 * @method string getQueryCount()
 * @method string getSceneId()
 * @method string getOperationRuleId()
 * @method string getPreviewType()
 * @method string getPage()
 */
class ListSceneItems extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/scenes/[sceneId]/items';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSelectionRuleId($value)
    {
        $this->data['SelectionRuleId'] = $value;
        $this->options['query']['selectionRuleId'] = $value;

        return $this;
    }

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
    public function withSize($value)
    {
        $this->data['Size'] = $value;
        $this->options['query']['size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQueryCount($value)
    {
        $this->data['QueryCount'] = $value;
        $this->options['query']['queryCount'] = $value;

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
    public function withOperationRuleId($value)
    {
        $this->data['OperationRuleId'] = $value;
        $this->options['query']['operationRuleId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPreviewType($value)
    {
        $this->data['PreviewType'] = $value;
        $this->options['query']['previewType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['page'] = $value;

        return $this;
    }
}
