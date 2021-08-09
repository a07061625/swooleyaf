<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UserDataUpdate
 *
 * @method string getIid()
 * @method string getUploadFile()
 * @method string getName()
 * @method string getBid()
 * @method string getType()
 */
class UserDataUpdateRequest extends RpcAcsRequest
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
            'cloudwf',
            '2017-03-28',
            'UserDataUpdate',
            'cloudwf'
        );
    }

    /**
     * @param string $iid
     *
     * @return $this
     */
    public function setIid($iid)
    {
        $this->requestParameters['Iid'] = $iid;
        $this->queryParameters['Iid'] = $iid;

        return $this;
    }

    /**
     * @param string $uploadFile
     *
     * @return $this
     */
    public function setUploadFile($uploadFile)
    {
        $this->requestParameters['UploadFile'] = $uploadFile;
        $this->queryParameters['UploadFile'] = $uploadFile;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $bid
     *
     * @return $this
     */
    public function setBid($bid)
    {
        $this->requestParameters['Bid'] = $bid;
        $this->queryParameters['Bid'] = $bid;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->requestParameters['Type'] = $type;
        $this->queryParameters['Type'] = $type;

        return $this;
    }
}
