<?php
final class SyFrameLoader
{
    /**
     * @var \SyFrameLoader
     */
    private static $instance = null;
    /**
     * @var array
     */
    private $preHandleMap = [];
    /**
     * swift mailer未初始化标识 true：未初始化 false：已初始化
     *
     * @var bool
     */
    private $swiftMailerStatus = true;
    /**
     * smarty未初始化标识 true：未初始化 false：已初始化
     *
     * @var bool
     */
    private $smartyStatus = true;
    /**
     * @var array
     */
    private $smartyRootClasses = [];
    /**
     * fpdf未初始化标识 true：未初始化 false：已初始化
     *
     * @var bool
     */
    private $fpdfStatus = true;
    /**
     * excel未初始化标识 true：未初始化 false：已初始化
     *
     * @var bool
     */
    private $excelStatus = true;
    /**
     * pinyin未初始化标识 true：未初始化 false：已初始化
     *
     * @var bool
     */
    private $pinYinStatus = true;
    /**
     * GuzzleHttp未初始化标识 true：未初始化 false：已初始化
     *
     * @var bool
     */
    private $guzzleHttpStatus = true;
    /**
     * AlibabaCloud未初始化标识 true：未初始化 false：已初始化
     *
     * @var bool
     */
    private $alibabaCloudStatus = true;
    /**
     * DingTalk未初始化标识 true：未初始化 false：已初始化
     *
     * @var bool
     */
    private $dingTalkStatus = true;

    private function __construct()
    {
        $this->preHandleMap = [
            'FPdf' => 'preHandleFPdf',
            'Twig' => 'preHandleTwig',
            'Swift' => 'preHandleSwift',
            'Resque' => 'preHandleResque',
            'Smarty' => 'preHandleSmarty',
            'SmartyBC' => 'preHandleSmarty',
            'PHPExcel' => 'preHandlePhpExcel',
            'PinYin' => 'preHandlePinYin',
            'ClickHouseDB' => 'preHandleClickHouse',
            'GuzzleHttp' => 'preHandleGuzzleHttp',
            'AlibabaCloud' => 'preHandleAlibabaCloud',
            'SyDingTalk' => 'preHandleDingTalk',
        ];

        $this->smartyRootClasses = [
            'smarty' => 'smarty.php',
            'smartybc' => 'smartybc.php',
        ];
    }

    private function __clone()
    {
        //null
    }

    /**
     * @return \SyFrameLoader
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 加载文件
     *
     * @param string $className 类名
     */
    public function loadFile(string $className): bool
    {
        $nameArr = explode('/', $className);
        $funcName = $this->preHandleMap[$nameArr[0]] ?? null;
        if (null === $funcName) {
            $nameArr = explode('_', $className);
            $funcName = $this->preHandleMap[$nameArr[0]] ?? null;
        }

        $file = null === $funcName ? SY_FRAME_LIBS_ROOT . $className . '.php' : $this->{$funcName}($className);
        if (is_file($file) && is_readable($file)) {
            require_once $file;

            return true;
        }

        return false;
    }

    private function preHandleFPdf(string $className): string
    {
        if ($this->fpdfStatus) {
            define('FPDF_VERSION', '1.81');
            $this->fpdfStatus = false;
        }

        return SY_FRAME_LIBS_ROOT . $className . '.php';
    }

    private function preHandleTwig(string $className): string
    {
        return SY_FRAME_LIBS_ROOT . 'SyTemplate/' . $className . '.php';
    }

    private function preHandleSwift(string $className): string
    {
        if ($this->swiftMailerStatus) { //加载swift mailer依赖文件
            $this->swiftMailerStatus = false;
            require_once SY_FRAME_LIBS_ROOT . 'Mailer/Swift/depends/cache_deps.php';
            require_once SY_FRAME_LIBS_ROOT . 'Mailer/Swift/depends/mime_deps.php';
            require_once SY_FRAME_LIBS_ROOT . 'Mailer/Swift/depends/message_deps.php';
            require_once SY_FRAME_LIBS_ROOT . 'Mailer/Swift/depends/transport_deps.php';
            require_once SY_FRAME_LIBS_ROOT . 'Mailer/Swift/depends/preferences.php';
        }

        return SY_FRAME_LIBS_ROOT . 'Mailer/' . str_replace('_', '/', $className) . '.php';
    }

    private function preHandleResque(string $className): string
    {
        return SY_FRAME_LIBS_ROOT . 'Queue/' . str_replace('_', '/', $className) . '.php';
    }

    private function preHandleSmarty(string $className): string
    {
        if ($this->smartyStatus) {
            $smartyLibDir = SY_FRAME_LIBS_ROOT . 'SyTemplate/Smarty/libs/';
            define('SMARTY_DIR', $smartyLibDir);
            define('SMARTY_SYSPLUGINS_DIR', $smartyLibDir . '/sysplugins/');
            define('SMARTY_RESOURCE_CHAR_SET', 'UTF-8');

            $this->smartyStatus = false;
        }

        $lowerClassName = strtolower($className);
        if (isset($this->smartyRootClasses[$lowerClassName])) {
            return SMARTY_DIR . $this->smartyRootClasses[$lowerClassName];
        }

        return SMARTY_SYSPLUGINS_DIR . $lowerClassName . '.php';
    }

    private function preHandlePhpExcel(string $className): string
    {
        if ($this->excelStatus) {
            define('PHPEXCEL_ROOT', SY_FRAME_LIBS_ROOT . 'PhpOffice/');
            define('EULER', 2.71828182845904523536);
            define('FINANCIAL_MAX_ITERATIONS', 128);
            define('FINANCIAL_PRECISION', 1.0e-08);
            define('MAX_VALUE', 1.2e308);
            define('M_2DIVPI', 0.63661977236758134307553505349006);
            define('MAX_ITERATIONS', 256);
            define('PRECISION', 8.88E-016);
            define('LOG_GAMMA_X_MAX_VALUE', 2.55e305);
            define('XMININ', 2.23e-308);
            define('EPS', 2.22e-16);
            define('SQRT2PI', 2.5066282746310005024157652848110452530069867406099);
            if (defined('PREG_BAD_UTF8_ERROR')) {
                // Cell reference (cell or range of cells, with or without a sheet reference)
                define('CALCULATION_REGEXP_CELLREF', '((([^\s,!&%^\/\*\+<>=-]*)|(\'[^\']*\')|(\"[^\"]*\"))!)?\$?([a-z]{1,3})\$?(\d{1,7})');
                // Named Range of cells
                define('CALCULATION_REGEXP_NAMEDRANGE', '((([^\s,!&%^\/\*\+<>=-]*)|(\'[^\']*\')|(\"[^\"]*\"))!)?([_A-Z][_A-Z0-9\.]*)');
            } else {
                // Cell reference (cell or range of cells, with or without a sheet reference)
                define('CALCULATION_REGEXP_CELLREF', '(((\w*)|(\'[^\']*\')|(\"[^\"]*\"))!)?\$?([a-z]{1,3})\$?(\d+)');
                // Named Range of cells
                define('CALCULATION_REGEXP_NAMEDRANGE', '(((\w*)|(\'.*\')|(\".*\"))!)?([_A-Z][_A-Z0-9\.]*)');
            }

            $this->excelStatus = false;
        }

        return SY_FRAME_LIBS_ROOT . 'PhpOffice/' . str_replace('_', '/', $className) . '.php';
    }

    private function preHandlePinYin(string $className): string
    {
        if ($this->pinYinStatus) {
            define('PINYIN_DEFAULT', 4096);
            define('PINYIN_TONE', 2);
            define('PINYIN_NO_TONE', 4);
            define('PINYIN_ASCII_TONE', 8);
            define('PINYIN_NAME', 16);
            define('PINYIN_KEEP_NUMBER', 32);
            define('PINYIN_KEEP_ENGLISH', 64);
            define('PINYIN_UMLAUT_V', 128);
            define('PINYIN_KEEP_PUNCTUATION', 256);
            $this->pinYinStatus = false;
        }

        return SY_FRAME_LIBS_ROOT . 'SyTranslation/' . $className . '.php';
    }

    private function preHandleClickHouse(string $className): string
    {
        return SY_FRAME_LIBS_ROOT . 'SyDriver/' . $className . '.php';
    }

    private function preHandleGuzzleHttp(string $className): string
    {
        if ($this->guzzleHttpStatus) {
            require_once SY_FRAME_LIBS_ROOT . 'GuzzleHttp/functions.php';
            require_once SY_FRAME_LIBS_ROOT . 'GuzzleHttp/Promise/functions.php';
            $this->guzzleHttpStatus = false;
        }

        return SY_FRAME_LIBS_ROOT . $className . '.php';
    }

    private function preHandleAlibabaCloud(string $className): string
    {
        if ($this->alibabaCloudStatus) {
            require_once SY_FRAME_LIBS_ROOT . 'AlibabaCloud/Client/Functions.php';
            $this->alibabaCloudStatus = false;
        }

        return SY_FRAME_LIBS_ROOT . $className . '.php';
    }

    private function preHandleDingTalk(string $className): string
    {
        if ($this->dingTalkStatus) {
            define('TOP_SDK_WORK_DIR', '/tmp/');
            //开发程序的时候设为true,以免缓存造成你的代码修改了不生效
            //设定为false,能提高运行速度(对应的代价就是你下次升级程序时要清一下缓存)
            define('TOP_SDK_DEV_MODE', true);
            $this->dingTalkStatus = false;
        }

        return SY_FRAME_LIBS_ROOT . $className . '.php';
    }
}

final class SyProjectLoader
{
    /**
     * @var \SyProjectLoader
     */
    private static $instance = null;

    private function __construct()
    {
        //null
    }

    /**
     * @return \SyProjectLoader
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 加载文件
     *
     * @param string $className 类名
     */
    public function loadFile(string $className): bool
    {
        $file = SY_PROJECT_LIBS_ROOT . $className . '.php';
        if (is_file($file) && is_readable($file)) {
            require_once $file;

            return true;
        }

        return false;
    }
}

/**
 * 基础公共类自动加载
 *
 * @param string $className 类全名
 *
 * @return bool
 */
function syFrameAutoload(string $className)
{
    $trueName = str_replace([
        '\\',
        "\0",
    ], [
        '/',
        '',
    ], $className);

    return SyFrameLoader::getInstance()->loadFile($trueName);
}

/**
 * 项目公共类自动加载
 *
 * @param string $className 类全名
 *
 * @return bool
 */
function syProjectAutoload(string $className)
{
    $trueName = str_replace([
        '\\',
        "\0",
    ], [
        '/',
        '',
    ], $className);

    return SyProjectLoader::getInstance()->loadFile($trueName);
}

spl_autoload_register('syFrameAutoload');
spl_autoload_register('syProjectAutoload');

require_once __DIR__ . '/helper_defines.php';

if (!function_exists('trigger_deprecation')) {
    /**
     * Triggers a silenced deprecation notice.
     *
     * @param string $package The name of the Composer package that is triggering the deprecation
     * @param string $version The version of the package that introduced the deprecation
     * @param string $message The message of the deprecation
     * @param mixed  ...$args Values to insert in the message using printf() formatting
     *
     * @author Nicolas Grekas <p@tchwork.com>
     */
    function trigger_deprecation(string $package, string $version, string $message, ...$args): void
    {
        $msg = '';
        if ($package || $version) {
            $msg = 'Since ' . $package . ' ' . $version . ': ';
        }
        if ($args) {
            $msg .= vsprintf($message, $args);
        } else {
            $msg .= $message;
        }
        @trigger_error($msg, E_USER_DEPRECATED);
    }
}

if (!function_exists('getallheaders')) {
    /**
     * Get all HTTP header key/values as an associative array for the current request.
     *
     * @return array[string] The HTTP header key/value pairs
     */
    function getallheaders(): array
    {
        $headers = [];

        $copy_server = [
            'CONTENT_TYPE' => 'Content-Type',
            'CONTENT_LENGTH' => 'Content-Length',
            'CONTENT_MD5' => 'Content-Md5',
        ];

        foreach ($_SERVER as $key => $value) {
            if ('HTTP_' === substr($key, 0, 5)) {
                $key = substr($key, 5);
                if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                    $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                    $headers[$key] = $value;
                }
            } elseif (isset($copy_server[$key])) {
                $headers[$copy_server[$key]] = $value;
            }
        }

        if (!isset($headers['Authorization'])) {
            if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
                $basic_pass = $_SERVER['PHP_AUTH_PW'] ?? '';
                $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
            } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
            }
        }

        return $headers;
    }
}
