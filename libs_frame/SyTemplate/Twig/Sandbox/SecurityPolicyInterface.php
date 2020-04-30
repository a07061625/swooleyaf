<?php
/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Twig\Sandbox;

/**
 * Interface that all security policy classes must implements.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface SecurityPolicyInterface
{
    /**
     * @throws SecurityError
     *
     * @param mixed $tags
     * @param mixed $filters
     * @param mixed $functions
     */
    public function checkSecurity($tags, $filters, $functions): void;

    /**
     * @throws SecurityNotAllowedMethodError
     *
     * @param mixed $obj
     * @param mixed $method
     */
    public function checkMethodAllowed($obj, $method): void;

    /**
     * @throws SecurityNotAllowedPropertyError
     *
     * @param mixed $obj
     * @param mixed $method
     */
    public function checkPropertyAllowed($obj, $method): void;
}
