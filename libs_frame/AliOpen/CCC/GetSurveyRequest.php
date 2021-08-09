<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetSurvey
 *
 * @method string getSurveyId()
 * @method string getInstanceId()
 * @method string getScenarioId()
 */
class GetSurveyRequest extends RpcAcsRequest
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
            'CCC',
            '2017-07-05',
            'GetSurvey',
            'CCC'
        );
    }

    /**
     * @param string $surveyId
     *
     * @return $this
     */
    public function setSurveyId($surveyId)
    {
        $this->requestParameters['SurveyId'] = $surveyId;
        $this->queryParameters['SurveyId'] = $surveyId;

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $scenarioId
     *
     * @return $this
     */
    public function setScenarioId($scenarioId)
    {
        $this->requestParameters['ScenarioId'] = $scenarioId;
        $this->queryParameters['ScenarioId'] = $scenarioId;

        return $this;
    }
}
