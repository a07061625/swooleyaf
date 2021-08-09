<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateSurvey
 *
 * @method string getRole()
 * @method string getDescription()
 * @method string getSpeechOptimizationParam()
 * @method string getInstanceId()
 * @method string getRound()
 * @method string getFlowJson()
 * @method string getName()
 * @method string getGlobalQuestions()
 * @method string getCorpora()
 * @method string getScenarioId()
 */
class CreateSurveyRequest extends RpcAcsRequest
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
            'CreateSurvey',
            'CCC'
        );
    }

    /**
     * @param string $role
     *
     * @return $this
     */
    public function setRole($role)
    {
        $this->requestParameters['Role'] = $role;
        $this->queryParameters['Role'] = $role;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $speechOptimizationParam
     *
     * @return $this
     */
    public function setSpeechOptimizationParam($speechOptimizationParam)
    {
        $this->requestParameters['SpeechOptimizationParam'] = $speechOptimizationParam;
        $this->queryParameters['SpeechOptimizationParam'] = $speechOptimizationParam;

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
     * @param string $round
     *
     * @return $this
     */
    public function setRound($round)
    {
        $this->requestParameters['Round'] = $round;
        $this->queryParameters['Round'] = $round;

        return $this;
    }

    /**
     * @param string $flowJson
     *
     * @return $this
     */
    public function setFlowJson($flowJson)
    {
        $this->requestParameters['FlowJson'] = $flowJson;
        $this->queryParameters['FlowJson'] = $flowJson;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $globalQuestions
     *
     * @return $this
     */
    public function setGlobalQuestions($globalQuestions)
    {
        $this->requestParameters['GlobalQuestions'] = $globalQuestions;
        $this->queryParameters['GlobalQuestions'] = $globalQuestions;

        return $this;
    }

    /**
     * @param string $corpora
     *
     * @return $this
     */
    public function setCorpora($corpora)
    {
        $this->requestParameters['Corpora'] = $corpora;
        $this->queryParameters['Corpora'] = $corpora;

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
