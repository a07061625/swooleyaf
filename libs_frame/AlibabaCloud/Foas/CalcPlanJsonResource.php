<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getJobName()
 */
class CalcPlanJsonResource extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/planjson-resource';

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
    public function withJobName($value)
    {
        $this->data['JobName'] = $value;
        $this->pathParameters['jobName'] = $value;

        return $this;
    }
}
