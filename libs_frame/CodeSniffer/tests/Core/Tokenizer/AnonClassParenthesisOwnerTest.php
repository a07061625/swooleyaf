<?php
/**
 * Tests the adding of the "parenthesis" keys to an anonymous class token.
 *
 * @author    Juliette Reinders Folmer <phpcs_nospam@adviesenzo.nl>
 * @copyright 2019 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\Tokenizer;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

/**
 * @internal
 * @coversNothing
 */
final class AnonClassParenthesisOwnerTest extends AbstractMethodUnitTest
{
    /**
     * Test that anonymous class tokens without parenthesis do not get assigned a parenthesis owner.
     *
     * @param string $testMarker The comment which prefaces the target token in the test file.
     *
     * @dataProvider dataAnonClassNoParentheses
     * @covers       \PHP_CodeSniffer\Tokenizers\PHP::processAdditional
     */
    public function testAnonClassNoParentheses($testMarker)
    {
        $tokens = self::$phpcsFile->getTokens();

        $anonClass = $this->getTargetToken($testMarker, T_ANON_CLASS);
        static::assertArrayNotHasKey('parenthesis_owner', $tokens[$anonClass]);
        static::assertArrayNotHasKey('parenthesis_opener', $tokens[$anonClass]);
        static::assertArrayNotHasKey('parenthesis_closer', $tokens[$anonClass]);
    }

    //end testAnonClassNoParentheses()

    /**
     * Test that the next open/close parenthesis after an anonymous class without parenthesis
     * do not get assigned the anonymous class as a parenthesis owner.
     *
     * @param string $testMarker The comment which prefaces the target token in the test file.
     *
     * @dataProvider dataAnonClassNoParentheses
     * @covers       \PHP_CodeSniffer\Tokenizers\PHP::processAdditional
     */
    public function testAnonClassNoParenthesesNextOpenClose($testMarker)
    {
        $tokens = self::$phpcsFile->getTokens();
        $function = $this->getTargetToken($testMarker, T_FUNCTION);

        $opener = $this->getTargetToken($testMarker, T_OPEN_PARENTHESIS);
        static::assertArrayHasKey('parenthesis_owner', $tokens[$opener]);
        static::assertSame($function, $tokens[$opener]['parenthesis_owner']);

        $closer = $this->getTargetToken($testMarker, T_CLOSE_PARENTHESIS);
        static::assertArrayHasKey('parenthesis_owner', $tokens[$closer]);
        static::assertSame($function, $tokens[$closer]['parenthesis_owner']);
    }

    //end testAnonClassNoParenthesesNextOpenClose()

    /**
     * Data provider.
     *
     * @see testAnonClassNoParentheses()
     * @see testAnonClassNoParenthesesNextOpenClose()
     *
     * @return array
     */
    public function dataAnonClassNoParentheses()
    {
        return [
            ['/* testNoParentheses */'],
            ['/* testNoParenthesesAndEmptyTokens */'],
        ];
    }

    //end dataAnonClassNoParentheses()

    /**
     * Test that anonymous class tokens with parenthesis get assigned a parenthesis owner,
     * opener and closer; and that the opener/closer get the anonymous class assigned as owner.
     *
     * @param string $testMarker The comment which prefaces the target token in the test file.
     *
     * @dataProvider dataAnonClassWithParentheses
     * @covers       \PHP_CodeSniffer\Tokenizers\PHP::processAdditional
     */
    public function testAnonClassWithParentheses($testMarker)
    {
        $tokens = self::$phpcsFile->getTokens();
        $anonClass = $this->getTargetToken($testMarker, T_ANON_CLASS);
        $opener = $this->getTargetToken($testMarker, T_OPEN_PARENTHESIS);
        $closer = $this->getTargetToken($testMarker, T_CLOSE_PARENTHESIS);

        static::assertArrayHasKey('parenthesis_owner', $tokens[$anonClass]);
        static::assertArrayHasKey('parenthesis_opener', $tokens[$anonClass]);
        static::assertArrayHasKey('parenthesis_closer', $tokens[$anonClass]);
        static::assertSame($anonClass, $tokens[$anonClass]['parenthesis_owner']);
        static::assertSame($opener, $tokens[$anonClass]['parenthesis_opener']);
        static::assertSame($closer, $tokens[$anonClass]['parenthesis_closer']);

        static::assertArrayHasKey('parenthesis_owner', $tokens[$opener]);
        static::assertArrayHasKey('parenthesis_opener', $tokens[$opener]);
        static::assertArrayHasKey('parenthesis_closer', $tokens[$opener]);
        static::assertSame($anonClass, $tokens[$opener]['parenthesis_owner']);
        static::assertSame($opener, $tokens[$opener]['parenthesis_opener']);
        static::assertSame($closer, $tokens[$opener]['parenthesis_closer']);

        static::assertArrayHasKey('parenthesis_owner', $tokens[$closer]);
        static::assertArrayHasKey('parenthesis_opener', $tokens[$closer]);
        static::assertArrayHasKey('parenthesis_closer', $tokens[$closer]);
        static::assertSame($anonClass, $tokens[$closer]['parenthesis_owner']);
        static::assertSame($opener, $tokens[$closer]['parenthesis_opener']);
        static::assertSame($closer, $tokens[$closer]['parenthesis_closer']);
    }

    //end testAnonClassWithParentheses()

    /**
     * Data provider.
     *
     * @see testAnonClassWithParentheses()
     *
     * @return array
     */
    public function dataAnonClassWithParentheses()
    {
        return [
            ['/* testWithParentheses */'],
            ['/* testWithParenthesesAndEmptyTokens */'],
        ];
    }

    //end dataAnonClassWithParentheses()
}//end class
