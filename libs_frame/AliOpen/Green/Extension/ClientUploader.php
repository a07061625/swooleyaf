<?php
namespace AliOpen\Green\Extension;

use AliOpen\Green\CredentialsUploadRequest;
use SyObjectStorage\Oss\Core\OssException;
use SyObjectStorage\Oss\OssClient;

class ClientUploader
{
    private $client;
    private $uploadCredentials;
    private $headers;
    private $fileType;
    private $dir = '/tmp/green/upload/';

    private function __construct($client, $fileType)
    {
        $this->client = $client;
        $this->uploadCredentials = null;
        $this->headers = [];
        $this->fileType = $fileType;
    }

    public static function getImageClientUploader($client)
    {
        return new self($client, 'images');
    }

    public static function getVideoClientUploader($client)
    {
        return new self($client, 'videos');
    }

    public static function getVoiceClientUploader($client)
    {
        return new self($client, 'voices');
    }

    public static function getFileClientUploader($client)
    {
        return new self($client, 'files');
    }

    /**
     * 上传并获取上传后的图片链接
     *
     * @param string $bytes
     *
     * @return string
     *
     * @throws \Exception
     */
    public function uploadBytes($bytes)
    {
        if (!file_exists($this->dir)) {
            mkdir($this->dir, 0777, true);
        }
        $tmpFileName = $this->dir . uniqid();
        $file = fopen($tmpFileName, 'w'); //打开文件准备写入
        fwrite($file, $bytes); //写入
        fclose($file); //关闭

        try {
            $result = $this->uploadFile($tmpFileName);
            unlink($tmpFileName);

            return $result;
        } catch (\Exception $e) {
            unlink($tmpFileName);

            throw $e;
        }
    }

    /**
     * 上传并获取上传后的图片链接
     *
     * @param $filePath
     *
     * @return string
     *
     * @throws \SyObjectStorage\Oss\Core\OssException
     * @throws \SyObjectStorage\Oss\Http\RequestCore_Exception
     */
    public function uploadFile($filePath)
    {
        $uploadCredentials = $this->getCredentials();
        if ($uploadCredentials == null) {
            throw new \RuntimeException('can not get upload credentials');
        }

        try {
            $ossClient = new OssClient($uploadCredentials->getAccessKeyId(), $uploadCredentials->getAccessKeySecret(), $uploadCredentials->getOssEndpoint(), false, $uploadCredentials->getSecurityToken());
            print_r($uploadCredentials->getUploadFolder() . $this->fileType);
            $object = $uploadCredentials->getUploadFolder() . '/' . $this->fileType . '/' . uniqid();
            print_r($object);
            $ossClient->uploadFile($uploadCredentials->getUploadBucket(), $object, $filePath);

            return 'oss://' . $uploadCredentials->getUploadBucket() . '/' . $object;
        } catch (OssException $e) {
            throw $e;
        }
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    private function getCredentials()
    {
        if ($this->uploadCredentials == null || $this->uploadCredentials->getExpiredTime() < $this->getMillisecond()) {
            $this->uploadCredentials = $this->getCredentialsFromServer();
        }

        return $this->uploadCredentials;
    }

    private function getMillisecond()
    {
        [$microsecond, $time] = explode(' ', microtime()); //' '中间是一个空格

        return (float)sprintf('%.0f', (floatval($microsecond) + floatval($time)) * 1000);
    }

    private function getCredentialsFromServer()
    {
        $uploadCredentialsRequest = new CredentialsUploadRequest();
        $uploadCredentialsRequest->setMethod('POST');
        $uploadCredentialsRequest->setAcceptFormat('JSON');

        $uploadCredentialsRequest->setContent(json_encode([]));
        foreach ($this->headers as $k => $v) {
            $uploadCredentialsRequest->putPathParameter($k, $v);
        }

        $uploadCredentialsRequest->setContent(json_encode([]));

        try {
            $response = $this->client->getAcsResponse($uploadCredentialsRequest);
            print_r($response);
            if (200 == $response->code) {
                $data = $response->data;

                return new UploadCredentials($data->accessKeyId, $data->accessKeySecret, $data->securityToken, $data->expiredTime, $data->ossEndpoint, $data->uploadBucket, $data->uploadFolder);
            }

            throw new \RuntimeException('get upload credential from server fail. requestId:' . $response->requestId . ', code:'
                                        . $response->code);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
