<?php
namespace AliOpen\Core;

use AliOpen\Core\Auth\EcsRamRoleService;
use AliOpen\Core\Auth\RamRoleArnService;
use AliOpen\Core\Exception\ClientException;
use AliOpen\Core\Exception\ServerException;
use AliOpen\Core\Regions\EndpointProvider;
use AliOpen\Core\Http\HttpHelper;
use AliOpen\Core\Regions\LocationService;

class DefaultAcsClient implements IAcsClient {
    /**
     * @var \AliOpen\Core\Profile\IClientProfile
     */
    public $iClientProfile;
    /**
     * @var bool
     */
    public $__urlTestFlag__;
    /**
     * @var \AliOpen\Core\Regions\LocationService
     */
    private $locationService;
    /**
     * @var \AliOpen\Core\Auth\RamRoleArnService
     */
    private $ramRoleArnService;
    /**
     * @var \AliOpen\Core\Auth\EcsRamRoleService
     */
    private $ecsRamRoleService;

    /**
     * AliOpen\Core\DefaultAcsClient constructor.
     * @param $iClientProfile
     */
    public function __construct($iClientProfile){
        $this->iClientProfile = $iClientProfile;
        $this->__urlTestFlag__ = false;
        $this->locationService = new LocationService($this->iClientProfile);
        if ($this->iClientProfile->isRamRoleArn()) {
            $this->ramRoleArnService = new RamRoleArnService($this->iClientProfile);
        }
        if ($this->iClientProfile->isEcsRamRole()) {
            $this->ecsRamRoleService = new EcsRamRoleService($this->iClientProfile);
        }
    }

    /**
     * @param      $request
     * @param null $iSigner
     * @param null $credential
     * @param bool $autoRetry
     * @param int $maxRetryNumber
     * @return mixed|\SimpleXMLElement
     * @throws \AliOpen\Core\Exception\ClientException
     * @throws \AliOpen\Core\Exception\ServerException
     */
    public function getAcsResponse($request,
        $iSigner = null,
        $credential = null,
        $autoRetry = true,
        $maxRetryNumber = 3){
        $httpResponse = $this->doActionImpl($request, $iSigner, $credential, $autoRetry, $maxRetryNumber);
        $respObject = $this->parseAcsResponse($httpResponse->getBody(), $request->getAcceptFormat());
        if (false == $httpResponse->isSuccess()) {
            $this->buildApiException($respObject, $httpResponse->getStatus());
        }

        return $respObject;
    }

    /**
     * @param      $request
     * @param null $iSigner
     * @param null $credential
     * @param bool $autoRetry
     * @param int $maxRetryNumber
     * @return \AliOpen\Core\Http\HttpResponse
     * @throws \AliOpen\Core\Exception\ClientException
     */
    private function doActionImpl($request, $iSigner = null, $credential = null, $autoRetry = true, $maxRetryNumber = 3){
        if (null == $this->iClientProfile
            && (null == $iSigner || null == $credential
                || null == $request->getRegionId()
                || null == $request->getAcceptFormat())) {
            throw new ClientException('No active profile found.', 'SDK.InvalidProfile');
        }
        if (null == $iSigner) {
            $iSigner = $this->iClientProfile->getSigner();
        }
        if (null == $credential) {
            $credential = $this->iClientProfile->getCredential();
        }
        if ($this->iClientProfile->isRamRoleArn()) {
            $credential = $this->ramRoleArnService->getSessionCredential();
        }
        if ($this->iClientProfile->isEcsRamRole()) {
            $credential = $this->ecsRamRoleService->getSessionCredential();
        }
        if (null == $credential) {
            throw new ClientException('Incorrect user credentials.', 'SDK.InvalidCredential');
        }

        $request = $this->prepareRequest($request);

        // Get the domain from the Location Service by speicified `ServiceCode` and `RegionId`.
        $domain = null;
        if (null != $request->getLocationServiceCode()) {
            $domain = $this->locationService->findProductDomain($request->getRegionId(), $request->getLocationServiceCode(),
                $request->getLocationEndpointType(), $request->getProduct());
        }
        if ($domain == null) {
            $domain = EndpointProvider::findProductDomain($request->getRegionId(), $request->getProduct());
        }

        if (null == $domain) {
            throw new ClientException('Can not find endpoint to access.', 'SDK.InvalidRegionId');
        }
        $requestUrl = $request->composeUrl($iSigner, $credential, $domain);

        if ($this->__urlTestFlag__) {
            throw new ClientException($requestUrl, 'URLTestFlagIsSet');
        }

        if (count($request->getDomainParameter()) > 0) {
            $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), $request->getDomainParameter(), $request->getHeaders());
        } else {
            $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), $request->getContent(), $request->getHeaders());
        }

        $retryTimes = 1;
        while (500 <= $httpResponse->getStatus() && $autoRetry && $retryTimes < $maxRetryNumber) {
            $requestUrl = $request->composeUrl($iSigner, $credential, $domain);

            if (count($request->getDomainParameter()) > 0) {
                $httpResponse =
                    HttpHelper::curl($requestUrl, $request->getMethod(), $request->getDomainParameter(), $request->getHeaders());
            } else {
                $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), $request->getContent(), $request->getHeaders());
            }
            $retryTimes ++;
        }

        return $httpResponse;
    }

    /**
     * @param \AliOpen\Core\AcsRequest $request
     * @param null $iSigner
     * @param null $credential
     * @param bool $autoRetry
     * @param int $maxRetryNumber
     * @return \AliOpen\Core\Http\HttpResponse|mixed
     * @throws \AliOpen\Core\Exception\ClientException
     */
    public function doAction($request, $iSigner = null, $credential = null, $autoRetry = true, $maxRetryNumber = 3){
        trigger_error('doAction() is deprecated. Please use getAcsResponse() instead.', E_USER_NOTICE);

        return $this->doActionImpl($request, $iSigner, $credential, $autoRetry, $maxRetryNumber);
    }

    /**
     * @param $request
     * @return mixed
     */
    private function prepareRequest($request){
        if (null == $request->getRegionId()) {
            $request->setRegionId($this->iClientProfile->getRegionId());
        }
        if (null == $request->getAcceptFormat()) {
            $request->setAcceptFormat($this->iClientProfile->getFormat());
        }
        if (null == $request->getMethod()) {
            $request->setMethod('GET');
        }

        return $request;
    }

    /**
     * @param object $respObject
     * @param int $httpStatus
     * @throws \AliOpen\Core\Exception\ServerException
     */
    private function buildApiException($respObject, $httpStatus){
        // Compatible with different results
        if (isset($respObject->Message, $respObject->Code, $respObject->RequestId)) {
            throw new ServerException($respObject->Message, $respObject->Code, $httpStatus, $respObject->RequestId);
        }

        if (isset($respObject->message, $respObject->code, $respObject->requestId)) {
            throw new ServerException($respObject->message, $respObject->code, $httpStatus, $respObject->requestId);
        }

        if (isset($respObject->errorMsg, $respObject->errorCode)) {
            throw new ServerException($respObject->errorMsg, $respObject->errorCode, $httpStatus, 'None');
        }

        throw new ServerException('The server returned an error without a detailed message. ', 'UnknownServerError', $httpStatus, 'None');
    }

    /**
     * @param $body
     * @param $format
     * @return mixed|\SimpleXMLElement
     */
    private function parseAcsResponse($body, $format){
        if ('JSON' === $format) {
            $respObject = json_decode($body);
        } elseif ('XML' === $format) {
            $respObject = @simplexml_load_string($body);
        } elseif ('RAW' === $format) {
            $respObject = $body;
        }

        return $respObject;
    }
}
