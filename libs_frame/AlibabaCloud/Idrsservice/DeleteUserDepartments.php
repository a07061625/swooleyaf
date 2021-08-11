<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method array getDepartmentId()
 * @method array getUserId()
 */
class DeleteUserDepartments extends Rpc
{
    /**
     * @return $this
     */
    public function withDepartmentId(array $departmentId)
    {
        $this->data['DepartmentId'] = $departmentId;
        foreach ($departmentId as $i => $iValue) {
            $this->options['query']['DepartmentId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withUserId(array $userId)
    {
        $this->data['UserId'] = $userId;
        foreach ($userId as $i => $iValue) {
            $this->options['form_params']['UserId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
