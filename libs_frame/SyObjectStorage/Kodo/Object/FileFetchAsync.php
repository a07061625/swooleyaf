<?php
/**
 * 异步第三方资源抓取
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 12:37
 */

namespace SyObjectStorage\Kodo\Object;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;
use SyTool\Tool;

class FileFetchAsync extends BaseKodo
{
    const CALLBACK_BODY_TYPE_FORM = 'application/x-www-form-urlencoded';
    const CALLBACK_BODY_TYPE_JSON = 'application/json';

    /**
     * 存储区域
     *
     * @var string
     */
    private $region = '';
    /**
     * 链接列表
     *
     * @var array
     */
    private $url = [];
    /**
     * 空间名称
     *
     * @var string
     */
    private $bucket = '';
    /**
     * 链接域名
     *
     * @var string
     */
    private $host = '';
    /**
     * 文件存储key
     *
     * @var string
     */
    private $key = '';
    /**
     * 文件md5
     *
     * @var string
     */
    private $md5 = '';
    /**
     * 文件etag
     *
     * @var string
     */
    private $etag = '';
    /**
     * 回调URL
     *
     * @var string
     */
    private $callbackurl = '';
    /**
     * 回调Body
     *
     * @var array
     */
    private $callbackbody = [];
    /**
     * 回调Body内容类型
     *
     * @var string
     */
    private $callbackbodytype = '';
    /**
     * 回调域名
     *
     * @var string
     */
    private $callbackhost = '';
    /**
     * 存储文件类型 0:正常存储(默认) 1:低频存储
     *
     * @var int
     */
    private $file_type = 0;
    /**
     * 忽略标识 false:已存在同名文件则放弃抓取 true:已存在同名文件则继续抓取
     *
     * @var bool
     */
    private $ignore_same_key = false;

    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
        $this->serviceUri = '/sisyphus/fetch';
        $this->reqHeader['Content-Type'] = 'application/json';
        $this->reqData = [
            'callbackbodytype' => self::CALLBACK_BODY_TYPE_FORM,
            'file_type' => 0,
            'ignore_same_key' => false,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setRegion(string $region)
    {
        if (isset(self::$totalRegionType[$region])) {
            $this->region = $region;
            $this->setServiceHost('api-' . $region . '.qiniu.com');
        } else {
            throw new KodoException('存储区域不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setUrl(array $urlList)
    {
        if (empty($urlList)) {
            throw new KodoException('链接列表不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->url = [];
        foreach ($urlList as $eUrl) {
            if (\is_string($eUrl) && (\strlen($eUrl) > 0)) {
                $this->url[] = $eUrl;
            }
        }
        array_unique($this->url);
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setBucket(string $bucket)
    {
        if (ctype_alnum($bucket)) {
            $this->reqData['bucket'] = $bucket;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setHost(string $host)
    {
        if (\strlen($host) > 0) {
            $this->reqData['host'] = $host;
        } else {
            throw new KodoException('链接域名不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setKey(string $key)
    {
        if (\strlen($key) > 0) {
            $this->reqData['key'] = $key;
        } else {
            throw new KodoException('文件存储key不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setMd5(string $md5)
    {
        if (ctype_alnum($md5) && (32 == \strlen($md5))) {
            $this->reqData['md5'] = $md5;
        } else {
            throw new KodoException('文件md5不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setEtag(string $etag)
    {
        if (\strlen($etag) > 0) {
            $this->reqData['etag'] = $etag;
        } else {
            throw new KodoException('文件etag不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setCallbackUrl(string $callbackUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $callbackUrl) > 0) {
            $this->reqData['callbackurl'] = $callbackUrl;
        } else {
            throw new KodoException('回调URL不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setCallbackBody(array $callbackBody)
    {
        if (empty($callbackBody)) {
            throw new KodoException('回调Body不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->callbackbody = $callbackBody;
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setCallbackBodyType(string $callbackBodyType)
    {
        if (\in_array($callbackBodyType, [self::CALLBACK_BODY_TYPE_FORM, self::CALLBACK_BODY_TYPE_JSON])) {
            $this->reqData['callbackbodytype'] = $callbackBodyType;
        } else {
            throw new KodoException('回调Body内容类型不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setCallbackHost(string $callbackHost)
    {
        if (\strlen($callbackHost) > 0) {
            $this->reqData['callbackhost'] = $callbackHost;
        } else {
            throw new KodoException('回调域名不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setFileType(int $fileType)
    {
        if (\in_array($fileType, [0, 1])) {
            $this->reqData['file_type'] = $fileType;
        } else {
            throw new KodoException('存储文件类型不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    public function setIgnoreSameKey(bool $ignoreSameKey)
    {
        $this->reqData['ignore_same_key'] = $ignoreSameKey;
    }

    public function getDetail(): array
    {
        if (0 == \strlen($this->region)) {
            throw new KodoException('存储区域不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (empty($this->url)) {
            throw new KodoException('链接列表不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['bucket'])) {
            throw new KodoException('空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (isset($this->reqData['callbackurl'])) {
            if (empty($this->callbackbody)) {
                throw new KodoException('回调Body不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
            }
            if (self::CALLBACK_BODY_TYPE_FORM == $this->reqData['callbackbodytype']) {
                $this->reqData['callbackbody'] = http_build_query($this->callbackbody);
            } else {
                $this->reqData['callbackbody'] = Tool::jsonEncode($this->callbackbody, JSON_UNESCAPED_UNICODE);
            }
        }
        $this->reqData['url'] = implode(';', $this->url);

        $body = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->reqHeader['Authorization'] = 'Qiniu ' . Util::createAccessToken($this->accessKey, $this->serviceUri, $body);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $body;

        return $this->getContent();
    }
}
