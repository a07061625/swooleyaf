<?php
/**
 * A doc generator that outputs text-based documentation.
 *
 * Output is designed to be displayed in a terminal and is wrapped to 100 characters.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Generators;

class Text extends Generator
{
    /**
     * Process the documentation for a single sniff.
     *
     * @param \DOMNode $doc The DOMNode object for the sniff.
     *                      It represents the "documentation" tag in the XML
     *                      standard file.
     */
    public function processSniff(\DOMNode $doc)
    {
        $this->printTitle($doc);

        foreach ($doc->childNodes as $node) {
            if ('standard' === $node->nodeName) {
                $this->printTextBlock($node);
            } elseif ('code_comparison' === $node->nodeName) {
                $this->printCodeComparisonBlock($node);
            }
        }
    }

    //end processSniff()

    /**
     * Prints the title area for a single sniff.
     *
     * @param \DOMNode $doc The DOMNode object for the sniff.
     *                      It represents the "documentation" tag in the XML
     *                      standard file.
     */
    protected function printTitle(\DOMNode $doc)
    {
        $title = $this->getTitle($doc);
        $standard = $this->ruleset->name;

        echo PHP_EOL;
        echo str_repeat('-', (\strlen("{$standard} CODING STANDARD: {$title}") + 4));
        echo strtoupper(PHP_EOL . "| {$standard} CODING STANDARD: {$title} |" . PHP_EOL);
        echo str_repeat('-', (\strlen("{$standard} CODING STANDARD: {$title}") + 4));
        echo PHP_EOL . PHP_EOL;
    }

    //end printTitle()

    /**
     * Print a text block found in a standard.
     *
     * @param \DOMNode $node The DOMNode object for the text block.
     */
    protected function printTextBlock(\DOMNode $node)
    {
        $text = trim($node->nodeValue);
        $text = str_replace('<em>', '*', $text);
        $text = str_replace('</em>', '*', $text);

        $nodeLines = explode("\n", $text);
        $lines = [];

        foreach ($nodeLines as $currentLine) {
            $currentLine = trim($currentLine);
            if ('' === $currentLine) {
                // The text contained a blank line. Respect this.
                $lines[] = '';

                continue;
            }

            $tempLine = '';
            $words = explode(' ', $currentLine);

            foreach ($words as $word) {
                $currentLength = \strlen($tempLine . $word);
                if ($currentLength < 99) {
                    $tempLine .= $word . ' ';

                    continue;
                }

                if (99 === $currentLength || 100 === $currentLength) {
                    // We are already at the edge, so we are done.
                    $lines[] = $tempLine . $word;
                    $tempLine = '';
                } else {
                    $lines[] = rtrim($tempLine);
                    $tempLine = $word . ' ';
                }
            }//end foreach

            if ('' !== $tempLine) {
                $lines[] = rtrim($tempLine);
            }
        }//end foreach

        echo implode(PHP_EOL, $lines) . PHP_EOL . PHP_EOL;
    }

    //end printTextBlock()

    /**
     * Print a code comparison block found in a standard.
     *
     * @param \DOMNode $node The DOMNode object for the code comparison block.
     */
    protected function printCodeComparisonBlock(\DOMNode $node)
    {
        $codeBlocks = $node->getElementsByTagName('code');
        $first = trim($codeBlocks->item(0)->nodeValue);
        $firstTitle = $codeBlocks->item(0)->getAttribute('title');

        $firstTitleLines = [];
        $tempTitle = '';
        $words = explode(' ', $firstTitle);

        foreach ($words as $word) {
            if (\strlen($tempTitle . $word) >= 45) {
                if (45 === \strlen($tempTitle . $word)) {
                    // Adding the extra space will push us to the edge
                    // so we are done.
                    $firstTitleLines[] = $tempTitle . $word;
                    $tempTitle = '';
                } elseif (46 === \strlen($tempTitle . $word)) {
                    // We are already at the edge, so we are done.
                    $firstTitleLines[] = $tempTitle . $word;
                    $tempTitle = '';
                } else {
                    $firstTitleLines[] = $tempTitle;
                    $tempTitle = $word . ' ';
                }
            } else {
                $tempTitle .= $word . ' ';
            }
        }//end foreach

        if ('' !== $tempTitle) {
            $firstTitleLines[] = $tempTitle;
        }

        $first = str_replace('<em>', '', $first);
        $first = str_replace('</em>', '', $first);
        $firstLines = explode("\n", $first);

        $second = trim($codeBlocks->item(1)->nodeValue);
        $secondTitle = $codeBlocks->item(1)->getAttribute('title');

        $secondTitleLines = [];
        $tempTitle = '';
        $words = explode(' ', $secondTitle);

        foreach ($words as $word) {
            if (\strlen($tempTitle . $word) >= 45) {
                if (45 === \strlen($tempTitle . $word)) {
                    // Adding the extra space will push us to the edge
                    // so we are done.
                    $secondTitleLines[] = $tempTitle . $word;
                    $tempTitle = '';
                } elseif (46 === \strlen($tempTitle . $word)) {
                    // We are already at the edge, so we are done.
                    $secondTitleLines[] = $tempTitle . $word;
                    $tempTitle = '';
                } else {
                    $secondTitleLines[] = $tempTitle;
                    $tempTitle = $word . ' ';
                }
            } else {
                $tempTitle .= $word . ' ';
            }
        }//end foreach

        if ('' !== $tempTitle) {
            $secondTitleLines[] = $tempTitle;
        }

        $second = str_replace('<em>', '', $second);
        $second = str_replace('</em>', '', $second);
        $secondLines = explode("\n", $second);

        $maxCodeLines = max(\count($firstLines), \count($secondLines));
        $maxTitleLines = max(\count($firstTitleLines), \count($secondTitleLines));

        echo str_repeat('-', 41);
        echo ' CODE COMPARISON ';
        echo str_repeat('-', 42) . PHP_EOL;

        for ($i = 0; $i < $maxTitleLines; ++$i) {
            if (true === isset($firstTitleLines[$i])) {
                $firstLineText = $firstTitleLines[$i];
            } else {
                $firstLineText = '';
            }

            if (true === isset($secondTitleLines[$i])) {
                $secondLineText = $secondTitleLines[$i];
            } else {
                $secondLineText = '';
            }

            echo '| ';
            echo $firstLineText . str_repeat(' ', (46 - \strlen($firstLineText)));
            echo ' | ';
            echo $secondLineText . str_repeat(' ', (47 - \strlen($secondLineText)));
            echo ' |' . PHP_EOL;
        }//end for

        echo str_repeat('-', 100) . PHP_EOL;

        for ($i = 0; $i < $maxCodeLines; ++$i) {
            if (true === isset($firstLines[$i])) {
                $firstLineText = $firstLines[$i];
            } else {
                $firstLineText = '';
            }

            if (true === isset($secondLines[$i])) {
                $secondLineText = $secondLines[$i];
            } else {
                $secondLineText = '';
            }

            echo '| ';
            echo $firstLineText . str_repeat(' ', max(0, (47 - \strlen($firstLineText))));
            echo '| ';
            echo $secondLineText . str_repeat(' ', max(0, (48 - \strlen($secondLineText))));
            echo '|' . PHP_EOL;
        }//end for

        echo str_repeat('-', 100) . PHP_EOL . PHP_EOL;
    }

    //end printCodeComparisonBlock()
}//end class
