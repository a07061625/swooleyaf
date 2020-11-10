<?php
/**
 * Tests for the \PHP_CodeSniffer\Files\File:findImplementedInterfaceNames method.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\File;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

/**
 * @internal
 * @coversNothing
 */
final class FindImplementedInterfaceNamesTest extends AbstractMethodUnitTest
{
    /**
     * Test retrieving the name(s) of the interfaces being implemented by a class.
     *
     * @param string $identifier Comment which precedes the test case.
     * @param bool   $expected   Expected function output.
     *
     * @dataProvider dataImplementedInterface
     */
    public function testFindImplementedInterfaceNames($identifier, $expected)
    {
        $OOToken = $this->getTargetToken($identifier, [T_CLASS, T_ANON_CLASS, T_INTERFACE]);
        $result = self::$phpcsFile->findImplementedInterfaceNames($OOToken);
        static::assertSame($expected, $result);
    }

    //end testFindImplementedInterfaceNames()

    /**
     * Data provider for the FindImplementedInterfaceNames test.
     *
     * @see testFindImplementedInterfaceNames()
     *
     * @return array
     */
    public function dataImplementedInterface()
    {
        return [
            [
                '/* testImplementedClass */',
                ['testFIINInterface'],
            ],
            [
                '/* testMultiImplementedClass */',
                [
                    'testFIINInterface',
                    'testFIINInterface2',
                ],
            ],
            [
                '/* testNamespacedClass */',
                ['\PHP_CodeSniffer\Tests\Core\File\testFIINInterface'],
            ],
            [
                '/* testNonImplementedClass */',
                false,
            ],
            [
                '/* testInterface */',
                false,
            ],
            [
                '/* testClassThatExtendsAndImplements */',
                [
                    'InterfaceA',
                    '\NameSpaced\Cat\InterfaceB',
                ],
            ],
            [
                '/* testClassThatImplementsAndExtends */',
                [
                    '\InterfaceA',
                    'InterfaceB',
                ],
            ],
        ];
    }

    //end dataImplementedInterface()
}//end class
