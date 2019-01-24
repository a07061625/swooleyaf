<?php
namespace AliOpen\Core\Exception;

class ServerException extends ClientException {
    /**
     * @var string
     */
    private $httpStatus;
    /**
     * @var string
     */
    private $requestId;

    /**
     * AliOpen\Core\Exception\ServerException constructor.
     * @param $errorMessage
     * @param $errorCode
     * @param $httpStatus
     * @param $requestId
     */
    public function __construct($errorMessage, $errorCode, $httpStatus, $requestId){
        $messageStr = $errorCode . ' ' . $errorMessage . ' HTTP Status: ' . $httpStatus . ' RequestID: ' . $requestId;
        parent::__construct($messageStr, $errorCode);
        $this->setErrorMessage($errorMessage);
        $this->setErrorType('Server');
        $this->httpStatus = $httpStatus;
        $this->requestId = $requestId;
    }

    /**
     * @return string
     */
    public function getHttpStatus(){
        return $this->httpStatus;
    }

    /**
     * @return string
     */
    public function getRequestId(){
        return $this->requestId;
    }
}
