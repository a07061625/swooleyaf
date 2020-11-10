<?php
/**
 * Makes sure that shorthand PHP open tags are not used.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class DisallowShortOpenTagSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        $targets = [
            T_OPEN_TAG,
            T_OPEN_TAG_WITH_ECHO,
        ];

        $shortOpenTags = (bool)ini_get('short_open_tag');
        if (false === $shortOpenTags) {
            $targets[] = T_INLINE_HTML;
        }

        return $targets;
    }

    //end register()

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token = $tokens[$stackPtr];

        if (T_OPEN_TAG === $token['code'] && '<?' === $token['content']) {
            $error = 'Short PHP opening tag used; expected "<?php" but found "%s"';
            $data = [$token['content']];
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Found', $data);
            if (true === $fix) {
                $correctOpening = '<?php';
                if (true === isset($tokens[($stackPtr + 1)]) && T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
                    // Avoid creation of invalid open tags like <?phpecho if the original was <?echo .
                    $correctOpening .= ' ';
                }

                $phpcsFile->fixer->replaceToken($stackPtr, $correctOpening);
            }

            $phpcsFile->recordMetric($stackPtr, 'PHP short open tag used', 'yes');
        } else {
            $phpcsFile->recordMetric($stackPtr, 'PHP short open tag used', 'no');
        }

        if (T_OPEN_TAG_WITH_ECHO === $token['code']) {
            $nextVar = $tokens[$phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true)];
            $error = 'Short PHP opening tag used with echo; expected "<?php echo %s ..." but found "%s %s ..."';
            $data = [
                $nextVar['content'],
                $token['content'],
                $nextVar['content'],
            ];
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'EchoFound', $data);
            if (true === $fix) {
                if (T_WHITESPACE !== $tokens[($stackPtr + 1)]['code']) {
                    $phpcsFile->fixer->replaceToken($stackPtr, '<?php echo ');
                } else {
                    $phpcsFile->fixer->replaceToken($stackPtr, '<?php echo');
                }
            }
        }

        if (T_INLINE_HTML === $token['code']) {
            $content = $token['content'];
            $openerFound = strpos($content, '<?');

            if (false === $openerFound) {
                return;
            }

            $closerFound = false;

            // Inspect current token and subsequent inline HTML token to find a close tag.
            for ($i = $stackPtr; $i < $phpcsFile->numTokens; ++$i) {
                if (T_INLINE_HTML !== $tokens[$i]['code']) {
                    break;
                }

                $closerFound = strrpos($tokens[$i]['content'], '?>');
                if (false !== $closerFound) {
                    if ($i !== $stackPtr) {
                        break;
                    }
                    if ($closerFound > $openerFound) {
                        break;
                    }
                    $closerFound = false;
                }
            }

            if (false !== $closerFound) {
                $error = 'Possible use of short open tags detected; found: %s';
                $snippet = $this->getSnippet($content, '<?');
                $data = ['<?' . $snippet];

                $phpcsFile->addWarning($error, $stackPtr, 'PossibleFound', $data);

                // Skip forward to the token containing the closer.
                if (($i - 1) > $stackPtr) {
                    return $i;
                }
            }
        }//end if
    }

    //end process()

    /**
     * Get a snippet from a HTML token.
     *
     * @param string $content The content of the HTML token.
     * @param string $start   Partial string to use as a starting point for the snippet.
     * @param int    $length  The target length of the snippet to get. Defaults to 40.
     *
     * @return string
     */
    protected function getSnippet($content, $start = '', $length = 40)
    {
        $startPos = 0;

        if ('' !== $start) {
            $startPos = strpos($content, $start);
            if (false !== $startPos) {
                $startPos += \strlen($start);
            }
        }

        $snippet = substr($content, $startPos, $length);
        if ((\strlen($content) - $startPos) > $length) {
            $snippet .= '...';
        }

        return $snippet;
    }

    //end getSnippet()
}//end class
