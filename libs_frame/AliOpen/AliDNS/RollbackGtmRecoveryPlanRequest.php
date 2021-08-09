<?php

namespace AliOpen\AliDNS;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RollbackGtmRecoveryPlan
 *
 * @method string getUserClientIp()
 * @method string getRecoveryPlanId()
 * @method string getLang()
 */
class RollbackGtmRecoveryPlanRequest extends RpcAcsRequest
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
            'Alidns',
            '2015-01-09',
            'RollbackGtmRecoveryPlan',
            'alidns'
        );
    }

    /**
     * @param string $userClientIp
     *
     * @return $this
     */
    public function setUserClientIp($userClientIp)
    {
        $this->requestParameters['UserClientIp'] = $userClientIp;
        $this->queryParameters['UserClientIp'] = $userClientIp;

        return $this;
    }

    /**
     * @param string $recoveryPlanId
     *
     * @return $this
     */
    public function setRecoveryPlanId($recoveryPlanId)
    {
        $this->requestParameters['RecoveryPlanId'] = $recoveryPlanId;
        $this->queryParameters['RecoveryPlanId'] = $recoveryPlanId;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }
}
