<?php
namespace AliOpen\Core\Exception;

class ClientException extends \Exception {
    /**
     * @var string
     */
    private $errorCode;
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var string
     */
    private $errorType;

    /**
     * AliOpen\Core\Exception\ClientException constructor.
     * @param $errorMessage
     * @param $errorCode
     */
    public function __construct($errorMessage, $errorCode){
        parent::__construct($errorMessage);
        $this->errorMessage = $errorMessage;
        $this->errorCode = $errorCode;
        $this->setErrorType('Client');
    }

    /**
     * @return string
     */
    public function getErrorCode(){
        return $this->errorCode;
    }

    /**
     * @param $errorCode
     */
    public function setErrorCode($errorCode){
        $this->errorCode = $errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage(){
        return $this->errorMessage;
    }

    /**
     * @param $errorMessage
     */
    public function setErrorMessage($errorMessage){
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getErrorType(){
        return $this->errorType;
    }

    /**
     * @param $errorType
     */
    public function setErrorType($errorType){
        $this->errorType = $errorType;
    }
}
