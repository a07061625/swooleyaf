<?php

namespace League\CLImate\TerminalObject\Router;

interface RouterInterface
{
    /**
     * @param $class
     *
     * @return string
     */
    public function path($class);

    /**
     * @param $class
     *
     * @return bool
     */
    public function exists($class);

    /**
     * @param $obj
     *
     * @return null|\League\CLImate\TerminalObject\Dynamic\DynamicTerminalObject
     */
    public function execute($obj);

    /**
     * @return string
     */
    public function pathPrefix();
}
