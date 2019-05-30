<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/10/9 0009
 * Time: 14:10
 */
namespace DesignPatterns\Singletons;

use Cache\Lite\CacheLite;
use Tool\Dir;
use Tool\Tool;
use Traits\SingletonTrait;

class CacheFileLiteSingleton
{
    use SingletonTrait;

    /**
     * @var \Cache\Lite\CacheLite
     */
    private $cache = null;

    private function __construct()
    {
        $configs = Tool::getConfig('caches.' . SY_ENV . SY_PROJECT . '.file.lite');
        Dir::create($configs['dir']);

        $this->cache = new CacheLite([
            'cacheDir' => $configs['dir'], //必须以/结尾
            'lifeTime' => $configs['timeout'],
        ]);
    }

    /**
     * @return \Cache\Lite\CacheLite
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance->cache;
    }
}
