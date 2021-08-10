<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getRankingModelId()
 */
class DeleteRankingModel extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/ranking-models/[rankingModelId]';

    /** @var string */
    public $method = 'DELETE';

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
    public function withRankingModelId($value)
    {
        $this->data['RankingModelId'] = $value;
        $this->pathParameters['rankingModelId'] = $value;

        return $this;
    }
}
