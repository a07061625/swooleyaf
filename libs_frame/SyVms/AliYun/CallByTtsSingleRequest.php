<?php
namespace SyVms\AliYun;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SingleCallByTts
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getTtsCode()
 * @method string getPlayTimes()
 * @method string getTtsParam()
 * @method string getOwnerId()
 * @method string getSpeed()
 * @method string getVolume()
 * @method string getCalledNumber()
 * @method string getCalledShowNumber()
 * @method string getOutId()
 */
class CallByTtsSingleRequest extends RpcAcsRequest
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
        parent::__construct('Dyvmsapi', '2017-05-25', 'SingleCallByTts', 'dyvmsapi');
    }

    /**
     * @param string $resourceOwnerId
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $ttsCode
     * @return $this
     */
    public function setTtsCode($ttsCode)
    {
        $this->requestParameters['TtsCode'] = $ttsCode;
        $this->queryParameters['TtsCode'] = $ttsCode;

        return $this;
    }

    /**
     * @param string $playTimes
     * @return $this
     */
    public function setPlayTimes($playTimes)
    {
        $this->requestParameters['PlayTimes'] = $playTimes;
        $this->queryParameters['PlayTimes'] = $playTimes;

        return $this;
    }

    /**
     * @param string $ttsParam
     * @return $this
     */
    public function setTtsParam($ttsParam)
    {
        $this->requestParameters['TtsParam'] = $ttsParam;
        $this->queryParameters['TtsParam'] = $ttsParam;

        return $this;
    }

    /**
     * @param string $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $speed
     * @return $this
     */
    public function setSpeed($speed)
    {
        $this->requestParameters['Speed'] = $speed;
        $this->queryParameters['Speed'] = $speed;

        return $this;
    }

    /**
     * @param string $volume
     * @return $this
     */
    public function setVolume($volume)
    {
        $this->requestParameters['Volume'] = $volume;
        $this->queryParameters['Volume'] = $volume;

        return $this;
    }

    /**
     * @param string $calledNumber
     * @return $this
     */
    public function setCalledNumber($calledNumber)
    {
        $this->requestParameters['CalledNumber'] = $calledNumber;
        $this->queryParameters['CalledNumber'] = $calledNumber;

        return $this;
    }

    /**
     * @param string $calledShowNumber
     * @return $this
     */
    public function setCalledShowNumber($calledShowNumber)
    {
        $this->requestParameters['CalledShowNumber'] = $calledShowNumber;
        $this->queryParameters['CalledShowNumber'] = $calledShowNumber;

        return $this;
    }

    /**
     * @param string $outId
     * @return $this
     */
    public function setOutId($outId)
    {
        $this->requestParameters['OutId'] = $outId;
        $this->queryParameters['OutId'] = $outId;

        return $this;
    }
}
