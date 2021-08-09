<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteScreenSetting
 *
 * @method string getSourceIp()
 * @method string getScreenTitle()
 */
class ScreenSettingDeleteRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'DeleteScreenSetting', 'vipaegis');
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
     * @param string $screenTitle
     *
     * @return $this
     */
    public function setScreenTitle($screenTitle)
    {
        $this->requestParameters['ScreenTitle'] = $screenTitle;
        $this->queryParameters['ScreenTitle'] = $screenTitle;

        return $this;
    }
}
