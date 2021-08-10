<?php

namespace League\CLImate\TerminalObject\Helper;

use League\CLImate\Exceptions\UnexpectedValueException;

use function preg_quote;

trait Art
{
    /**
     * The directories we should be looking for art in
     *
     * @var array $art_dirs
     */
    protected $art_dirs = [];

    /**
     * The default art if we can't find what the user requested
     *
     * @var string $default_art
     */
    protected $default_art = '404';

    /**
     * The art requested by the user
     *
     * @var string $art
     */
    protected $art = '';

    /**
     * Specify which settings Draw needs to import
     *
     * @return array
     */
    public function settings()
    {
        return ['Art'];
    }

    /**
     * Import the Art setting (any directories the user added)
     *
     * @param \League\CLImate\Settings\Art $setting
     */
    public function importSettingArt($setting)
    {
        foreach ($setting->dirs as $dir) {
            $this->addDir($dir);
        }
    }

    /**
     * Add a directory to search for art in
     *
     * @param string $dir
     */
    protected function addDir($dir)
    {
        // Add any additional directories to the top of the array
        // so that the user can override art
        array_unshift($this->art_dirs, rtrim($dir, \DIRECTORY_SEPARATOR));

        // Keep the array clean
        $this->art_dirs = array_unique($this->art_dirs);
        $this->art_dirs = array_filter($this->art_dirs);
        $this->art_dirs = array_values($this->art_dirs);
    }

    /**
     * Find a valid art path
     *
     * @param string $art
     *
     * @return array
     */
    protected function artDir($art)
    {
        return $this->fileSearch($art, preg_quote(\DIRECTORY_SEPARATOR) . '*.*');
    }

    /**
     * Find a valid art path
     *
     * @param string $art
     *
     * @return string
     */
    protected function artFile($art)
    {
        $files = $this->fileSearch($art, '(\.[^' . preg_quote(\DIRECTORY_SEPARATOR) . ']*)?$');

        if (count($files) === 0) {
            $this->addDir(__DIR__ . \DIRECTORY_SEPARATOR);
            $files = $this->fileSearch($this->default_art, '.*');
        }

        if (count($files) === 0) {
            throw new UnexpectedValueException("Unable to find an art file with the name '{$art}'");
        }

        return reset($files);
    }

    /**
     * Find a set of files in the current art directories
     * based on a pattern
     *
     * @param string $art
     * @param string $pattern
     *
     * @return array
     */
    protected function fileSearch($art, $pattern)
    {
        foreach ($this->art_dirs as $dir) {
            $directory_iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));

            $paths = [];
            $regex = '~' . preg_quote($art) . $pattern . '~';

            foreach ($directory_iterator as $file) {
                if ($file->isDir()) {
                    continue;
                }

                // Look for anything that has the $art filename
                if (preg_match($regex, $file)) {
                    $paths[] = $file->getPathname();
                }
            }

            asort($paths);

            // If we've got one, no need to look any further
            if (!empty($paths)) {
                return $paths;
            }
        }

        return [];
    }

    /**
     * Parse the contents of the file and return each line
     *
     * @param string $path
     *
     * @return array
     */
    protected function parse($path)
    {
        $output = file_get_contents($path);
        $output = explode("\n", $output);
        $output = array_map('rtrim', $output);

        return $output;
    }
}
