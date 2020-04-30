<?php

/**
 * Smarty compiler exception class
 *
 * @package Smarty
 */
class SmartyCompilerException extends SmartyException
{
    /**
     * The line number of the template error
     *
     * @type int|null
     */
    public $line;

    /**
     * The template source snippet relating to the error
     *
     * @type string|null
     */
    public $source;

    /**
     * The raw text of the error message
     *
     * @type string|null
     */
    public $desc;

    /**
     * The resource identifier or template name
     *
     * @type string|null
     */
    public $template;
    /**
     * @return string
     */
    public function __toString()
    {
        return ' --> Smarty Compiler: ' . $this->message . ' <-- ';
    }
}
