<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SaveSuspEventUserSetting
 *
 * @method string getSourceIp()
 * @method string getFrom()
 * @method string getLevelsOn()
 */
class SuspEventUserSettingSaveRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'SaveSuspEventUserSetting', 'vipaegis');
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $from
     *
     * @return $this
     */
    public function setFrom($from)
    {
        $this->requestParameters['From'] = $from;
        $this->queryParameters['From'] = $from;

        return $this;
    }

    /**
     * @param string $levelsOn
     *
     * @return $this
     */
    public function setLevelsOn($levelsOn)
    {
        $this->requestParameters['LevelsOn'] = $levelsOn;
        $this->queryParameters['LevelsOn'] = $levelsOn;

        return $this;
    }
}
