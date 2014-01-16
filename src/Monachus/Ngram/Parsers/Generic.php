<?php
/*
 Based on PHPir code: http://phpir.com/language-detection-with-n-grams
*/
namespace Monachus\Ngram\Parsers;

use Monachus\Interfaces\NgramParserInterface as NgramParserInterface;
use Monachus\String as String;
use Monachus\Ngram\NgramHeap as NgramHeap;

class Generic implements NgramParserInterface
{
    const SPACE_REPLACEMENT = "_";

    public function parse(String $string, $n = 3)
    {
        $ngrams = array();
        $len = $string->length();

        for($i = 0; $i < $len; $i++) {
            if($i > ($n - 2)) {
                $ng = '';

                for($j = $n-1; $j >= 0; $j--) 
                {
                    $ng .= $string->substract($i-$j, 1);
                }

                $ngram = new String($ng);
                $ngram->replace(" ", self::SPACE_REPLACEMENT);
                $offset = $ngram->toLowercase();

                if(isset($ngrams[$offset])) {
                    $ngrams[$offset] = (
                        array(
                            "count" => $ngrams[$offset]["count"] + 1,
                        )
                    );
                } else {
                    $ngrams[$offset] = (
                        array(
                            "count" => 1,
                        )
                    );
                }
            }
        }

        return $ngrams;
    }
}