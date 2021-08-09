<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of PutContactGroup
 *
 * @method string getDescribe()
 * @method string getContactGroupName()
 * @method array getContactNamess()
 */
class PutContactGroupRequest extends RpcAcsRequest
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
            'Cms',
            '2019-01-01',
            'PutContactGroup',
            'cms'
        );
    }

    /**
     * @param string $describe
     *
     * @return $this
     */
    public function setDescribe($describe)
    {
        $this->requestParameters['Describe'] = $describe;
        $this->queryParameters['Describe'] = $describe;

        return $this;
    }

    /**
     * @param string $contactGroupName
     *
     * @return $this
     */
    public function setContactGroupName($contactGroupName)
    {
        $this->requestParameters['ContactGroupName'] = $contactGroupName;
        $this->queryParameters['ContactGroupName'] = $contactGroupName;

        return $this;
    }

    /**
     * @return $this
     */
    public function setContactNamess(array $contactNames)
    {
        $this->requestParameters['ContactNamess'] = $contactNames;
        foreach ($contactNames as $i => $iValue) {
            $this->queryParameters['ContactNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
