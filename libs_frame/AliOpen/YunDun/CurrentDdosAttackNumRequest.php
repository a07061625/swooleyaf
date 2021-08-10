<?php

namespace AliOpen\YunDun;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CurrentDdosAttackNum
 */
class CurrentDdosAttackNumRequest extends RpcAcsRequest
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
        parent::__construct('Yundun', '2015-02-27', 'CurrentDdosAttackNum', 'yundun');
    }
}