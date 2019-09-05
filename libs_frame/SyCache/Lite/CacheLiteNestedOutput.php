<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/10/9 0009
 * Time: 12:34
 */
namespace SyCache\Lite;

/**
 * This class extends Cache_Lite and uses output buffering to get the data to cache.
 * It supports nesting of caches
 *
 * @package Cache_Lite
 * @author Markus Tacker <tacker@php.net>
 */
class CacheLiteNestedOutput extends CacheLiteOutput
{
    private $nestedIds = [];
    private $nestedGroups = [];

    /**
     * Start the cache
     *
     * @param string $id cache id
     * @param string $group name of the cache group
     * @param boolean $doNotTestCacheValidity if set to true, the cache validity won't be tested
     * @return boolean|string false if the cache is not hit else the data
     * @access public
     */
    public function start($id, $group = 'default', $doNotTestCacheValidity = false)
    {
        $this->nestedIds[] = $id;
        $this->nestedGroups[] = $group;
        $data = $this->get($id, $group, $doNotTestCacheValidity);
        if ($data !== false) {
            return $data;
        }
        ob_start();
        ob_implicit_flush(false);
        return false;
    }

    /**
     * Stop the cache
     *
     * @param boolen
     * @return string return contents of cache
     */
    public function end()
    {
        $data = ob_get_contents();
        ob_end_clean();
        $id = array_pop($this->nestedIds);
        $group = array_pop($this->nestedGroups);
        $this->save($data, $id, $group);
        return $data;
    }
}
