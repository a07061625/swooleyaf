<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getBizTitle()
 * @method string getOperatingSystem()
 * @method string getDescription()
 * @method string getLanguage()
 * @method string getTitle()
 * @method string getGroupName()
 * @method array getMiddleWareIdList()
 * @method string getStateType()
 * @method string getServiceType()
 * @method array getUserRoles()
 * @method string getBizCode()
 * @method string getNamespace()
 */
class CreateApp extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizTitle($value)
    {
        $this->data['BizTitle'] = $value;
        $this->options['form_params']['BizTitle'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOperatingSystem($value)
    {
        $this->data['OperatingSystem'] = $value;
        $this->options['form_params']['OperatingSystem'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLanguage($value)
    {
        $this->data['Language'] = $value;
        $this->options['form_params']['Language'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTitle($value)
    {
        $this->data['Title'] = $value;
        $this->options['form_params']['Title'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupName($value)
    {
        $this->data['GroupName'] = $value;
        $this->options['form_params']['GroupName'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withMiddleWareIdList(array $middleWareIdList)
    {
        $this->data['MiddleWareIdList'] = $middleWareIdList;
        foreach ($middleWareIdList as $i => $iValue) {
            $this->options['form_params']['MiddleWareIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStateType($value)
    {
        $this->data['StateType'] = $value;
        $this->options['form_params']['StateType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceType($value)
    {
        $this->data['ServiceType'] = $value;
        $this->options['form_params']['ServiceType'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withUserRoles(array $userRoles)
    {
        $this->data['UserRoles'] = $userRoles;
        foreach ($userRoles as $depth1 => $depth1Value) {
            if (isset($depth1Value['RoleName'])) {
                $this->options['form_params']['UserRoles.' . ($depth1 + 1) . '.RoleName'] = $depth1Value['RoleName'];
            }
            if (isset($depth1Value['UserType'])) {
                $this->options['form_params']['UserRoles.' . ($depth1 + 1) . '.UserType'] = $depth1Value['UserType'];
            }
            if (isset($depth1Value['UserId'])) {
                $this->options['form_params']['UserRoles.' . ($depth1 + 1) . '.UserId'] = $depth1Value['UserId'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizCode($value)
    {
        $this->data['BizCode'] = $value;
        $this->options['form_params']['BizCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespace($value)
    {
        $this->data['Namespace'] = $value;
        $this->options['form_params']['Namespace'] = $value;

        return $this;
    }
}
