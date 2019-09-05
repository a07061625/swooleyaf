<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/10/9 0009
 * Time: 12:32
 */
namespace SyCache\Lite;

/**
 * This class extends Cache_Lite and uses output buffering to get the data to cache.
 *
 * There are some examples in the 'docs/examples' file
 * Technical choices are described in the 'docs/technical' file
 *
 * @package Cache_Lite
 * @author Fabien MARTY <fab@php.net>
 */
class CacheLiteOutput extends CacheLite
{
    // --- Public methods ---

    /**
     * Constructor
     *
     * $options is an assoc. To have a look at availables options,
     * see the constructor of the Cache_Lite class in 'Cache_Lite.php'
     *
     * @param array $options options
     * @access public
     */
    public function __construct($options)
    {
        parent::__construct($options);
    }

    /**
     * PHP4 constructor for backwards compatibility with older code
     *
     * @param array $options Options
     */
    public function Cache_Lite_Output($options = [null])
    {
        self::__construct($options);
    }

    /**
     * Start the cache
     *
     * @param string $id cache id
     * @param string $group name of the cache group
     * @param boolean $doNotTestCacheValidity if set to true, the cache validity won't be tested
     * @return boolean true if the cache is hit (false else)
     * @access public
     */
    public function start($id, $group = 'default', $doNotTestCacheValidity = false)
    {
        $data = $this->get($id, $group, $doNotTestCacheValidity);
        if ($data !== false) {
            echo($data);
            return true;
        }
        ob_start();
        ob_implicit_flush(false);
        return false;
    }

    /**
     * Stop the cache
     *
     * @access public
     */
    public function end()
    {
        $data = ob_get_contents();
        ob_end_clean();
        $this->save($data, $this->_id, $this->_group);
        echo($data);
    }
}
