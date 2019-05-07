<?php
/**
 * Cache using PHP include
 */
namespace DB\Models\NotORM;

class NotORM_Cache_Include implements NotORM_Cache
{
    private $filename;
    private $data = [];

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->data = @include realpath($filename); // @ - file may not exist, realpath() to not include from include_path //! silently falls with syntax error and fails with unreadable file
        if (!is_array($this->data)) { // empty file returns 1
            $this->data = [];
        }
    }

    public function load($key)
    {
        if (!isset($this->data[$key])) {
            return;
        }
        return $this->data[$key];
    }

    public function save($key, $data)
    {
        if (!isset($this->data[$key]) || $this->data[$key] !== $data) {
            $this->data[$key] = $data;
            file_put_contents($this->filename, '<?php return ' . var_export($this->data, true) . ';', LOCK_EX);
        }
    }
}
