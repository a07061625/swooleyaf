<?php

namespace ClickHouseDB\Transport;

use const CURLOPT_HTTPGET;
use const CURLOPT_POST;

class CurlerRequest
{
    /**
     * @var array
     */
    public $extendinfo = [];

    /**
     * @var array|string
     */
    private $parameters = '';

    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $headers; // Parsed reponse header object.

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $method;

    /**
     * @var bool
     */
    private $id;

    /**
     * @var null|resource
     */
    private $handle;

    /** @var CurlerResponse */
    private $response;

    /** @var bool */
    private $_persistent = false;

    /**
     * @var bool
     */
    private $_attachFiles = false;

    /**
     * @var string
     */
    private $callback_class = '';

    /**
     * @var string
     */
    private $callback_functionName = '';

    /**
     * @var bool
     */
    private $_httpCompression = false;

    /**
     * @var callable
     */
    private $callback_function;

    /**
     * @var bool|resource
     */
    private $infile_handle = false;

    /**
     * @var int
     */
    private $_dns_cache = 120;

    /**
     * @var resource
     */
    private $resultFileHandle;

    /**
     * @var string
     */
    private $sslCa;

    /**
     * @param bool $id
     */
    public function __construct($id = false)
    {
        $this->id = $id;

        $this->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->header('Expires', '0');
        $this->header('Pragma', 'no-cache');

        $this->options = [
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 5, // Количество секунд ожидания при попытке соединения
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HEADER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_AUTOREFERER => 1, // при редиректе подставлять в «Referer:» значение из «Location:»
            CURLOPT_BINARYTRANSFER => 1, // передавать в binary-safe
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'smi2/PHPClickHouse/client',
        ];
    }

    public function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        if ($this->handle) {
            curl_close($this->handle);
        }
        $this->handle = null;
    }

    /**
     * @param array $attachFiles
     */
    public function attachFiles($attachFiles)
    {
        $this->header('Content-Type', 'multipart/form-data');

        $out = [];
        foreach ($attachFiles as $post_name => $file_path) {
            $out[$post_name] = new \CURLFile($file_path);
        }

        $this->_attachFiles = true;
        $this->parameters($out);
    }

    /**
     * @param bool $set
     *
     * @return $this
     */
    public function id($set = false)
    {
        if ($set) {
            $this->id = $set;
        }

        return $this;
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function setRequestExtendedInfo($params)
    {
        $this->extendinfo = $params;

        return $this;
    }

    /**
     * @param null|int|string $key
     *
     * @return mixed
     */
    public function getRequestExtendedInfo($key = null)
    {
        if ($key) {
            return isset($this->extendinfo[$key]) ? $this->extendinfo[$key] : false;
        }

        return $this->extendinfo;
    }

    /**
     * @return bool|resource
     */
    public function getInfileHandle()
    {
        return $this->infile_handle;
    }

    /**
     * @param string $file_name
     *
     * @return bool|resource
     */
    public function setInfile($file_name)
    {
        $this->header('Expect', '');
        $this->infile_handle = fopen($file_name, 'r');
        if (\is_resource($this->infile_handle)) {
            if ($this->_httpCompression) {
                $this->header('Content-Encoding', 'gzip');
                $this->header('Content-Type', 'application/x-www-form-urlencoded');

                stream_filter_append($this->infile_handle, 'zlib.deflate', STREAM_FILTER_READ, ['window' => 30]);

                $this->options[CURLOPT_SAFE_UPLOAD] = 1;
            } else {
                $this->options[CURLOPT_INFILESIZE] = filesize($file_name);
            }

            $this->options[CURLOPT_INFILE] = $this->infile_handle;
        }

        return $this->infile_handle;
    }

    /**
     * @param callable $callback
     */
    public function setCallbackFunction($callback)
    {
        $this->callback_function = $callback;
    }

    /**
     * @param callable $callback
     */
    public function setWriteFunction($callback)
    {
        $this->options[CURLOPT_WRITEFUNCTION] = $callback;
    }

    /**
     * @param callable $callback
     */
    public function setReadFunction($callback)
    {
        $this->options[CURLOPT_READFUNCTION] = $callback;
    }

    public function setHeaderFunction($callback)
    {
        $this->options[CURLOPT_HEADERFUNCTION] = $callback;
    }

    /**
     * @param string $classCallBack
     * @param string $functionName
     */
    public function setCallback($classCallBack, $functionName)
    {
        $this->callback_class = $classCallBack;
        $this->callback_functionName = $functionName;
    }

    public function onCallback()
    {
        if ($this->callback_function) {
            $x = $this->callback_function;
            $x($this);
        }

        if ($this->callback_class && $this->callback_functionName) {
            $c = $this->callback_functionName;
            $this->callback_class->{$c}($this);
        }
    }

    public function getDetails(): array
    {
        return [
            'url' => $this->url,
            'method' => $this->method,
            'parameters' => $this->parameters,
            'headers' => $this->headers,
        ];
    }

    /**
     * @param bool $result
     *
     * @return string
     */
    public function dump($result = false)
    {
        $message = "\n------------  Request ------------\n";
        $message .= 'URL:' . $this->url . "\n\n";
        $message .= 'METHOD:' . $this->method . "\n\n";
        $message .= 'PARAMS:' . print_r($this->parameters, true) . "\n";
        $message .= 'PARAMS:' . print_r($this->headers, true) . "\n";
        $message .= "-----------------------------------\n";

        if ($result) {
            return $message;
        }

        echo $message;

        return '';
    }

    /**
     * @return bool
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return $this
     */
    public function persistent()
    {
        $this->_persistent = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPersistent()
    {
        return $this->_persistent;
    }

    /**
     * @param int $sec
     *
     * @return $this
     */
    public function keepAlive($sec = 60)
    {
        $this->options[CURLOPT_FORBID_REUSE] = true;
        $this->headers['Connection'] = 'Keep-Alive';
        $this->headers['Keep-Alive'] = $sec;

        return $this;
    }

    /**
     * @param bool $flag
     *
     * @return $this
     */
    public function verbose($flag = true)
    {
        $this->options[CURLOPT_VERBOSE] = $flag;

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function header($key, $value)
    {
        $this->headers[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $head = [];
        foreach ($this->headers as $key => $value) {
            $head[] = sprintf('%s: %s', $key, $value);
        }

        return $head;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $id
     *
     * @return string
     */
    public function getUniqHash($id)
    {
        return $id . '.' . microtime() . mt_rand(0, 1000000);
    }

    /**
     * @param bool $flag
     */
    public function httpCompression($flag)
    {
        if ($flag) {
            $this->_httpCompression = $flag;
            $this->options[CURLOPT_ENCODING] = 'gzip';
        } else {
            $this->_httpCompression = false;
            unset($this->options[CURLOPT_ENCODING]);
        }
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return $this
     */
    public function authByBasicAuth($username, $password)
    {
        $this->options[CURLOPT_USERPWD] = sprintf('%s:%s', $username, $password);

        return $this;
    }

    public function authByHeaders($username, $password)
    {
        $this->headers['X-ClickHouse-User'] = $username;
        $this->headers['X-ClickHouse-Key'] = $password;

        return $this;
    }

    /**
     * @param array|string $data
     *
     * @return $this
     */
    public function parameters($data)
    {
        $this->parameters = $data;

        return $this;
    }

    /**
     * The number of seconds to wait when trying to connect. Use 0 for infinite waiting.
     *
     * @param int $seconds
     *
     * @return $this
     */
    public function connectTimeOut($seconds = 1)
    {
        $this->options[CURLOPT_CONNECTTIMEOUT] = $seconds;

        return $this;
    }

    /**
     * The maximum number of seconds (float) allowed to execute cURL functions.
     *
     * @param float $seconds
     *
     * @return $this
     */
    public function timeOut($seconds = 10)
    {
        return $this->timeOutMs((int)($seconds * 1000));
    }

    /**
     * @param array|mixed $data
     *
     * @return $this
     *
     * @throws \ClickHouseDB\Exception\TransportException
     */
    public function parameters_json($data)
    {
        $this->header('Content-Type', 'application/json, text/javascript; charset=utf-8');
        $this->header('Accept', 'application/json, text/javascript, */*; q=0.01');

        if (null === $data) {
            $this->parameters = '{}';

            return $this;
        }

        if (\is_string($data)) {
            $this->parameters = $data;

            return $this;
        }

        $this->parameters = json_encode($data);

        if (!$this->parameters && $data) {
            throw new \ClickHouseDB\Exception\TransportException('Cant json_encode: ' . (string)$data);
        }

        return $this;
    }

    /**
     * @return resource
     */
    public function getResultFileHandle()
    {
        return $this->resultFileHandle;
    }

    /**
     * @return bool
     */
    public function isResultFile()
    {
        return $this->resultFileHandle ? true : false;
    }

    /**
     * @param resource $h    resource
     * @param bool     $zlib
     *
     * @return $this
     */
    public function setResultFileHandle($h, $zlib = false)
    {
        $this->resultFileHandle = $h;
        if ($zlib) {
            $params = ['level' => 6, 'window' => 15, 'memory' => 9];
            stream_filter_append($this->resultFileHandle, 'zlib.deflate', STREAM_FILTER_WRITE, $params);
        }

        return $this;
    }

    /**
     * @return CurlerRequest
     */
    public function PUT()
    {
        return $this->execute('PUT');
    }

    /**
     * @return CurlerRequest
     */
    public function POST()
    {
        return $this->execute('POST');
    }

    /**
     * @return CurlerRequest
     */
    public function OPTIONS()
    {
        return $this->execute('OPTIONS');
    }

    /**
     * @return CurlerRequest
     */
    public function GET()
    {
        return $this->execute('GET');
    }

    /**
     * The number of seconds that DNS records are stored in memory. By default this parameter is 120 (2 minutes).
     *
     * @param int $set
     *
     * @return $this
     */
    public function setDnsCache($set)
    {
        $this->_dns_cache = $set;

        return $this;
    }

    /**
     * The number of seconds that DNS records are stored in memory. By default this parameter is 120 (2 minutes).
     *
     * @return int
     */
    public function getDnsCache()
    {
        return $this->_dns_cache;
    }

    /**
     * Sets client certificate
     *
     * @param string $filePath
     */
    public function setSslCa($filePath)
    {
        $this->option(CURLOPT_SSL_VERIFYPEER, true);
        $this->option(CURLOPT_CAINFO, $filePath);
    }

    /**
     * @return CurlerResponse
     *
     * @throws \ClickHouseDB\Exception\TransportException
     */
    public function response()
    {
        if (!$this->response) {
            throw new \ClickHouseDB\Exception\TransportException('Can`t fetch response - is empty');
        }

        return $this->response;
    }

    public function isResponseExists(): bool
    {
        return null !== $this->response;
    }

    public function setResponse(CurlerResponse $response): void
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $this->prepareRequest();

        return $this->handle;
    }

    /**
     * @throws \Exception
     */
    public function setFunctionProgress(callable $callback)
    {
        if (!\is_callable($callback)) {
            throw new \Exception('setFunctionProgress not is_callable');
        }

        $this->option(CURLOPT_NOPROGRESS, false);
        $this->option(CURLOPT_PROGRESSFUNCTION, $callback); // version 5.5.0
    }

    /**
     * The maximum allowed number of milliseconds to perform cURL functions.
     *
     * @param int $ms millisecond
     *
     * @return $this
     */
    protected function timeOutMs($ms = 10000)
    {
        $this->options[CURLOPT_TIMEOUT_MS] = $ms;

        return $this;
    }

    /**
     * @param int   $key
     * @param mixed $value
     *
     * @return $this
     */
    private function option($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @param string $method
     *
     * @return $this
     */
    private function execute($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return bool
     */
    private function prepareRequest()
    {
        if (!$this->handle) {
            $this->handle = curl_init();
        }

        $curl_opt = $this->options;
        $method = $this->method;

        if ($this->_attachFiles) {
            $curl_opt[CURLOPT_SAFE_UPLOAD] = true;
        }

        if ('GET' == strtoupper($method)) {
            $curl_opt[CURLOPT_HTTPGET] = true;
            $curl_opt[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
            $curl_opt[CURLOPT_POSTFIELDS] = false;
        } else {
            if ('POST' === strtoupper($method)) {
                $curl_opt[CURLOPT_POST] = true;
            }

            $curl_opt[CURLOPT_CUSTOMREQUEST] = strtoupper($method);

            if ($this->parameters) {
                $curl_opt[CURLOPT_POSTFIELDS] = $this->parameters;

                if (!\is_array($this->parameters)) {
                    $this->header('Content-Length', \strlen($this->parameters));
                }
            }
        }
        // CURLOPT_DNS_CACHE_TIMEOUT - Количество секунд, в течение которых в памяти хранятся DNS-записи.
        $curl_opt[CURLOPT_DNS_CACHE_TIMEOUT] = $this->getDnsCache();
        $curl_opt[CURLOPT_URL] = $this->url;

        if (!empty($this->headers) && count($this->headers)) {
            $curl_opt[CURLOPT_HTTPHEADER] = [];

            foreach ($this->headers as $key => $value) {
                $curl_opt[CURLOPT_HTTPHEADER][] = sprintf('%s: %s', $key, $value);
            }
        }

        if (!empty($curl_opt[CURLOPT_INFILE])) {
            $curl_opt[CURLOPT_PUT] = true;
        }

        if (!empty($curl_opt[CURLOPT_WRITEFUNCTION])) {
            $curl_opt[CURLOPT_HEADER] = false;
        }

        if ($this->resultFileHandle) {
            $curl_opt[CURLOPT_FILE] = $this->resultFileHandle;
            $curl_opt[CURLOPT_HEADER] = false;
        }

        if ($this->options[CURLOPT_VERBOSE]) {
            echo "\n-----------BODY REQUEST----------\n" . $curl_opt[CURLOPT_POSTFIELDS] . "\n------END--------\n";
        }
        curl_setopt_array($this->handle, $curl_opt);

        return true;
    }
}