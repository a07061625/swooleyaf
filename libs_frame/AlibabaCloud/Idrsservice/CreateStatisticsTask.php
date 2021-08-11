<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getDepartmentId()
 * @method string getDateTo()
 * @method $this withDateTo($value)
 * @method string getDateFrom()
 * @method $this withDateFrom($value)
 */
class CreateStatisticsTask extends Rpc
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
}
