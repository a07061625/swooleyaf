<?php
/**
 * Tests for the \PHP_CodeSniffer\Ruleset class.
 *
 * @author    Juliette Reinders Folmer <phpcs_nospam@adviesenzo.nl>
 * @copyright 2019 Juliette Reinders Folmer. All rights reserved.
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\Ruleset;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Ruleset;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class RuleInclusionTest extends TestCase
{
    /**
     * The Ruleset object.
     *
     * @var \PHP_CodeSniffer\Ruleset
     */
    protected static $ruleset;

    /**
     * Path to the ruleset file.
     *
     * @var string
     */
    private static $standard = '';

    /**
     * The original content of the ruleset.
     *
     * @var string
     */
    private static $contents = '';

    /**
     * Initialize the config and ruleset objects based on the `RuleInclusionTest.xml` ruleset file.
     */
    public static function setUpBeforeClass()
    {
        if (true === $GLOBALS['PHP_CODESNIFFER_PEAR']) {
            // This test will be skipped.
            return;
        }

        $standard = __DIR__ . '/' . basename(__FILE__, '.php') . '.xml';
        self::$standard = $standard;

        // On-the-fly adjust the ruleset test file to be able to test
        // sniffs included with relative paths.
        $contents = file_get_contents($standard);
        self::$contents = $contents;

        $repoRootDir = basename(\dirname(\dirname(\dirname(__DIR__))));

        $newPath = $repoRootDir;
        if (\DIRECTORY_SEPARATOR === '\\') {
            $newPath = str_replace('\\', '/', $repoRootDir);
        }

        $adjusted = str_replace('%path_root_dir%', $newPath, $contents);

        if (false === file_put_contents($standard, $adjusted)) {
            static::markTestSkipped('On the fly ruleset adjustment failed');
        }

        $config = new Config(["--standard={$standard}"]);
        self::$ruleset = new Ruleset($config);
    }

    //end setUpBeforeClass()

    /**
     * Initialize the test.
     */
    protected function setUp()
    {
        if (true === $GLOBALS['PHP_CODESNIFFER_PEAR']) {
            // PEAR installs test and sniff files into different locations
            // so these tests will not pass as they directly reference files
            // by relative location.
            static::markTestSkipped('Test cannot run from a PEAR install');
        }
    }

    //end setUp()

    /**
     * Reset ruleset file.
     */
    protected function tearDown()
    {
        file_put_contents(self::$standard, self::$contents);
    }

    //end tearDown()

    /**
     * Test that sniffs are registered.
     */
    public function testHasSniffCodes()
    {
        static::assertObjectHasAttribute('sniffCodes', self::$ruleset);
        static::assertCount(14, self::$ruleset->sniffCodes);
    }

    //end testHasSniffCodes()

    /**
     * Test that sniffs are correctly registered, independently on the syntax used to include the sniff.
     *
     * @param string $key   Expected array key.
     * @param string $value Expected array value.
     *
     * @dataProvider dataRegisteredSniffCodes
     */
    public function testRegisteredSniffCodes($key, $value)
    {
        static::assertArrayHasKey($key, self::$ruleset->sniffCodes);
        static::assertSame($value, self::$ruleset->sniffCodes[$key]);
    }

    //end testRegisteredSniffCodes()

    /**
     * Data provider.
     *
     * @see self::testRegisteredSniffCodes()
     *
     * @return array
     */
    public function dataRegisteredSniffCodes()
    {
        return [
            [
                'PSR1.Classes.ClassDeclaration',
                'PHP_CodeSniffer\Standards\PSR1\Sniffs\Classes\ClassDeclarationSniff',
            ],
            [
                'PSR1.Files.SideEffects',
                'PHP_CodeSniffer\Standards\PSR1\Sniffs\Files\SideEffectsSniff',
            ],
            [
                'PSR1.Methods.CamelCapsMethodName',
                'PHP_CodeSniffer\Standards\PSR1\Sniffs\Methods\CamelCapsMethodNameSniff',
            ],
            [
                'Generic.PHP.DisallowAlternativePHPTags',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DisallowAlternativePHPTagsSniff',
            ],
            [
                'Generic.PHP.DisallowShortOpenTag',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DisallowShortOpenTagSniff',
            ],
            [
                'Generic.Files.ByteOrderMark',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Files\ByteOrderMarkSniff',
            ],
            [
                'Squiz.Classes.ValidClassName',
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\ValidClassNameSniff',
            ],
            [
                'Generic.NamingConventions.UpperCaseConstantName',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\UpperCaseConstantNameSniff',
            ],
            [
                'Zend.NamingConventions.ValidVariableName',
                'PHP_CodeSniffer\Standards\Zend\Sniffs\NamingConventions\ValidVariableNameSniff',
            ],
            [
                'Generic.Arrays.ArrayIndent',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\ArrayIndentSniff',
            ],
            [
                'Generic.Metrics.CyclomaticComplexity',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CyclomaticComplexitySniff',
            ],
            [
                'Generic.Files.LineLength',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff',
            ],
            [
                'Generic.NamingConventions.CamelCapsFunctionName',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\CamelCapsFunctionNameSniff',
            ],
            [
                'Generic.Metrics.NestingLevel',
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff',
            ],
        ];
    }

    //end dataRegisteredSniffCodes()

    /**
     * Test that setting properties for standards, categories, sniffs works for all supported rule
     * inclusion methods.
     *
     * @param string $sniffClass    The name of the sniff class.
     * @param string $propertyName  The name of the changed property.
     * @param mixed  $expectedValue The value expected for the property.
     *
     * @dataProvider dataSettingProperties
     */
    public function testSettingProperties($sniffClass, $propertyName, $expectedValue)
    {
        static::assertObjectHasAttribute('sniffs', self::$ruleset);
        static::assertArrayHasKey($sniffClass, self::$ruleset->sniffs);
        static::assertObjectHasAttribute($propertyName, self::$ruleset->sniffs[$sniffClass]);

        $actualValue = self::$ruleset->sniffs[$sniffClass]->{$propertyName};
        static::assertSame($expectedValue, $actualValue);
    }

    //end testSettingProperties()

    /**
     * Data provider.
     *
     * @see self::testSettingProperties()
     *
     * @return array
     */
    public function dataSettingProperties()
    {
        return [
            'ClassDeclarationSniff' => [
                'PHP_CodeSniffer\Standards\PSR1\Sniffs\Classes\ClassDeclarationSniff',
                'setforallsniffs',
                true,
            ],
            'SideEffectsSniff' => [
                'PHP_CodeSniffer\Standards\PSR1\Sniffs\Files\SideEffectsSniff',
                'setforallsniffs',
                true,
            ],
            'ValidVariableNameSniff' => [
                'PHP_CodeSniffer\Standards\Zend\Sniffs\NamingConventions\ValidVariableNameSniff',
                'setforallincategory',
                true,
            ],
            'ArrayIndentSniff' => [
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\ArrayIndentSniff',
                'indent',
                '2',
            ],
            'LineLengthSniff' => [
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff',
                'lineLimit',
                '10',
            ],
            'CamelCapsFunctionNameSniff' => [
                'PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\CamelCapsFunctionNameSniff',
                'strict',
                false,
            ],
            'NestingLevelSniff-nestingLevel' => [
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff',
                'nestingLevel',
                '2',
            ],
            'NestingLevelSniff-setforsniffsinincludedruleset' => [
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff',
                'setforsniffsinincludedruleset',
                true,
            ],

            // Testing that setting a property at error code level does *not* work.
            'CyclomaticComplexitySniff' => [
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CyclomaticComplexitySniff',
                'complexity',
                10,
            ],
        ];
    }

    //end dataSettingProperties()
}//end class
