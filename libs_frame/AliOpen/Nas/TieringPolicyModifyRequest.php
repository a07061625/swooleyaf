<?php
namespace AliOpen\Nas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyTieringPolicy
 * @method string getAtime()
 * @method string getFileName()
 * @method string getSize()
 * @method string getRecallTime()
 * @method string getName()
 * @method string getDescription()
 * @method string getCtime()
 * @method string getMtime()
 */
class TieringPolicyModifyRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('NAS', '2017-06-26', 'ModifyTieringPolicy', 'nas');
    }

    /**
     * @param string $atime
     * @return $this
     */
    public function setAtime($atime)
    {
        $this->requestParameters['Atime'] = $atime;
        $this->queryParameters['Atime'] = $atime;

        return $this;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->requestParameters['FileName'] = $fileName;
        $this->queryParameters['FileName'] = $fileName;

        return $this;
    }

    /**
     * @param string $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->requestParameters['Size'] = $size;
        $this->queryParameters['Size'] = $size;

        return $this;
    }

    /**
     * @param string $recallTime
     * @return $this
     */
    public function setRecallTime($recallTime)
    {
        $this->requestParameters['RecallTime'] = $recallTime;
        $this->queryParameters['RecallTime'] = $recallTime;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $ctime
     * @return $this
     */
    public function setCtime($ctime)
    {
        $this->requestParameters['Ctime'] = $ctime;
        $this->queryParameters['Ctime'] = $ctime;

        return $this;
    }

    /**
     * @param string $mtime
     * @return $this
     */
    public function setMtime($mtime)
    {
        $this->requestParameters['Mtime'] = $mtime;
        $this->queryParameters['Mtime'] = $mtime;

        return $this;
    }
}
