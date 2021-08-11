<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getInstanceId()
 * @method string getVertexId()
 * @method string getJobName()
 */
class GetInstanceVertexTaskManagers extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/instances/[instanceId]/vertices/[vertexId]/taskmanagers';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->pathParameters['projectName'] = $value;

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
    public function withVertexId($value)
    {
        $this->data['VertexId'] = $value;
        $this->pathParameters['vertexId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobName($value)
    {
        $this->data['JobName'] = $value;
        $this->pathParameters['jobName'] = $value;

        return $this;
    }
}
