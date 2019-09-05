<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/10/9 0009
 * Time: 12:30
 */
namespace SyCache\Lite;

/**
 * This class extends Cache_Lite and offers a cache system driven by a master file
 *
 * With this class, cache validity is only dependent of a given file. Cache files
 * are valid only if they are older than the master file. It's a perfect way for
 * caching templates results (if the template file is newer than the cache, cache
 * must be rebuild...) or for config classes...
 * There are some examples in the 'docs/examples' file
 * Technical choices are described in the 'docs/technical' file
 *
 * @package Cache_Lite
 * @author Fabien MARTY <fab@php.net>
 */
class CacheLiteFile extends CacheLite
{
    // --- Private properties ---

    /**
     * Complete path of the file used for controlling the cache lifetime
     *
     * @var string $_masterFile
     */
    public $_masterFile = '';

    /**
     * Masterfile mtime
     *
     * @var int $_masterFile_mtime
     */
    public $_masterFile_mtime = 0;

    // --- Public methods ----

    /**
     * Constructor
     *
     * $options is an assoc. To have a look at availables options,
     * see the constructor of the Cache_Lite class in 'Cache_Lite.php'
     *
     * Comparing to Cache_Lite constructor, there is another option :
     * $options = array(
     *     (...) see Cache_Lite constructor
     *     'masterFile' => complete path of the file used for controlling the cache lifetime(string)
     * );
     *
     * @param array $options options
     * @access public
     */
    public function __construct($options = [null])
    {
        $options['lifetime'] = 0;
        parent::__construct($options);
        if (isset($options['masterFile'])) {
            $this->_masterFile = $options['masterFile'];
        } else {
            return $this->raiseError('Cache_Lite_File : masterFile option must be set !');
        }
        if (!($this->_masterFile_mtime = @filemtime($this->_masterFile))) {
            return $this->raiseError('Cache_Lite_File : Unable to read masterFile : ' . $this->_masterFile, -3);
        }
    }

    /**
     * PHP4 constructor for backwards compatibility with older code
     *
     * @param array $options Options
     */
    public function Cache_Lite_File($options = [null])
    {
        self::__construct($options);
    }

    /**
     * Test if a cache is available and (if yes) return it
     *
     * @param string $id cache id
     * @param string $group name of the cache group
     * @param boolean $doNotTestCacheValidity if set to true, the cache validity won't be tested
     * @return string data of the cache (else : false)
     * @access public
     */
    public function get($id, $group = 'default', $doNotTestCacheValidity = false)
    {
        if ($data = parent::get($id, $group, true)) {
            if ($filemtime = $this->lastModified()) {
                if ($filemtime > $this->_masterFile_mtime) {
                    return $data;
                }
            }
        }
        return false;
    }
}
