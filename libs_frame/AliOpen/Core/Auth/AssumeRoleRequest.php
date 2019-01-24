<?php
namespace AliOpen\Core\Auth;

use AliOpen\Core\RpcAcsRequest;

class AssumeRoleRequest extends RpcAcsRequest {
    /**
     * AliOpen\Core\Auth\AssumeRoleRequest constructor.
     * @param $roleArn
     * @param $roleSessionName
     */
    public function __construct($roleArn, $roleSessionName){
        parent::__construct(ALIOPEN_STS_PRODUCT_NAME, ALIOPEN_STS_VERSION, ALIOPEN_STS_ACTION);

        $this->queryParameters['RoleArn'] = $roleArn;
        $this->queryParameters['RoleSessionName'] = $roleSessionName;
        $this->queryParameters['DurationSeconds'] = ALIOPEN_ROLE_ARN_EXPIRE_TIME;
        $this->setRegionId(ALIOPEN_ROLE_ARN_EXPIRE_TIME);
        $this->setProtocol('https');

        $this->setAcceptFormat('JSON');
    }
}
