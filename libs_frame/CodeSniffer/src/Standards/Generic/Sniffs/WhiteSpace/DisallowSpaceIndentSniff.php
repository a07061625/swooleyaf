<?php
/**
 * Throws errors if spaces are used for indentation other than precision indentation.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class DisallowSpaceIndentSniff implements Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = [
        'PHP',
        'JS',
        'CSS',
    ];

    /**
     * The --tab-width CLI value that is being used.
     *
     * @var int
     */
    private $tabWidth;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [T_OPEN_TAG];
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile All the tokens found in the document.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tabsReplaced = false;
        if (null === $this->tabWidth) {
            if (false === isset($phpcsFile->config->tabWidth) || 0 === $phpcsFile->config->tabWidth) {
                // We have no idea how wide tabs are, so assume 4 spaces for fixing.
                // It shouldn't really matter because indent checks elsewhere in the
                // standard should fix things up.
                $this->tabWidth = 4;
            } else {
                $this->tabWidth = $phpcsFile->config->tabWidth;
                $tabsReplaced = true;
            }
        }

        $checkTokens = [
            T_WHITESPACE => true,
            T_INLINE_HTML => true,
            T_DOC_COMMENT_WHITESPACE => true,
            T_COMMENT => true,
        ];

        $eolLen = \strlen($phpcsFile->eolChar);

        $tokens = $phpcsFile->getTokens();
        for ($i = 0; $i < $phpcsFile->numTokens; ++$i) {
            if (1 !== $tokens[$i]['column'] || false === isset($checkTokens[$tokens[$i]['code']])) {
                continue;
            }

            // If the tokenizer hasn't replaced tabs with spaces, we need to do it manually.
            $token = $tokens[$i];
            if (false === $tabsReplaced) {
                $phpcsFile->tokenizer->replaceTabsInToken($token, ' ', ' ', $this->tabWidth);
                if (false !== strpos($token['content'], $phpcsFile->eolChar)) {
                    // Newline chars are not counted in the token length.
                    $token['length'] -= $eolLen;
                }
            }

            if (true === isset($tokens[$i]['orig_content'])) {
                $content = $tokens[$i]['orig_content'];
            } else {
                $content = $tokens[$i]['content'];
            }

            $expectedIndentSize = $token['length'];

            $recordMetrics = true;

            // If this is an inline HTML token or a subsequent line of a multi-line comment,
            // split the content into indentation whitespace and the actual HTML/text.
            $nonWhitespace = '';
            if ((T_INLINE_HTML === $tokens[$i]['code']
                || T_COMMENT === $tokens[$i]['code'])
                && preg_match('`^(\s*)(\S.*)`s', $content, $matches) > 0
            ) {
                if (true === isset($matches[1])) {
                    $content = $matches[1];

                    // Tabs are not replaced in content, so the "length" is wrong.
                    $matches[1] = str_replace("\t", str_repeat(' ', $this->tabWidth), $matches[1]);
                    $expectedIndentSize = \strlen($matches[1]);
                }

                if (true === isset($matches[2])) {
                    $nonWhitespace = $matches[2];
                }
            } elseif (true === isset($tokens[($i + 1)])
                && $tokens[$i]['line'] < $tokens[($i + 1)]['line']
            ) {
                // There is no content after this whitespace except for a newline.
                $content = rtrim($content, "\r\n");
                $nonWhitespace = $phpcsFile->eolChar;

                // Don't record metrics for empty lines.
                $recordMetrics = false;
            }//end if

            $foundSpaces = substr_count($content, ' ');
            $foundTabs = substr_count($content, "\t");

            if (0 === $foundSpaces && 0 === $foundTabs) {
                // Empty line.
                continue;
            }

            if (0 === $foundSpaces && $foundTabs > 0) {
                // All ok, nothing to do.
                if (true === $recordMetrics) {
                    $phpcsFile->recordMetric($i, 'Line indent', 'tabs');
                }

                continue;
            }

            if ((T_DOC_COMMENT_WHITESPACE === $tokens[$i]['code']
                || T_COMMENT === $tokens[$i]['code'])
                && ' ' === $content
            ) {
                // Ignore all non-indented comments, especially for recording metrics.
                continue;
            }

            // OK, by now we know there will be spaces.
            // We just don't know yet whether they need to be replaced or
            // are precision indentation, nor whether they are correctly
            // placed at the end of the whitespace.
            $tabAfterSpaces = strpos($content, "\t", strpos($content, ' '));

            // Calculate the expected tabs and spaces.
            $expectedTabs = (int)floor($expectedIndentSize / $this->tabWidth);
            $expectedSpaces = ($expectedIndentSize % $this->tabWidth);

            if (0 === $foundTabs) {
                if (true === $recordMetrics) {
                    $phpcsFile->recordMetric($i, 'Line indent', 'spaces');
                }

                if ($foundTabs === $expectedTabs && $foundSpaces === $expectedSpaces) {
                    // Ignore: precision indentation.
                    continue;
                }
            } else {
                if ($foundTabs === $expectedTabs && $foundSpaces === $expectedSpaces) {
                    // Precision indentation.
                    if (true === $recordMetrics) {
                        if (false !== $tabAfterSpaces) {
                            $phpcsFile->recordMetric($i, 'Line indent', 'mixed');
                        } else {
                            $phpcsFile->recordMetric($i, 'Line indent', 'tabs');
                        }
                    }

                    if (false === $tabAfterSpaces) {
                        // Ignore: precision indentation is already at the
                        // end of the whitespace.
                        continue;
                    }
                } elseif (true === $recordMetrics) {
                    $phpcsFile->recordMetric($i, 'Line indent', 'mixed');
                }
            }//end if

            $error = 'Tabs must be used to indent lines; spaces are not allowed';
            $fix = $phpcsFile->addFixableError($error, $i, 'SpacesUsed');
            if (true === $fix) {
                $padding = str_repeat("\t", $expectedTabs);
                $padding .= str_repeat(' ', $expectedSpaces);
                $phpcsFile->fixer->replaceToken($i, $padding . $nonWhitespace);
            }
        }//end for

        // Ignore the rest of the file.
        return $phpcsFile->numTokens + 1;
    }

    //end process()
}//end class
