<?php
namespace Monachus\Ngram\Parsers;

use Monachus\Interfaces\NgramParserInterface as NgramParserInterface;
use Monachus\String as String;
use Monachus\Ngram\NgramHeap as NgramHeap;

class Generic implements NgramParserInterface
{
    const SPACE_REPLACEMENT = "_";

    public function parse(String $string, $n = 3)
    {
        $beforeEncoding = mb_internal_encoding();
        mb_internal_encoding($string->getCharset());

        $ngrams = array();
        $len = $string->length();

        for($i = 0; $i < $len; $i++) {
            if($i > ($n - 2)) {
                $ng = '';

                for($j = $n-1; $j >= 0; $j--) 
                {
                    $ng .= $string->substract($i-$j, 1);
                }

                $ngram = mb_strtolower(mb_ereg_replace(" ", self::SPACE_REPLACEMENT, $ng));

                if(isset($ngrams[$ngram])) {
                    $ngrams[$ngram] = (
                        array(
                            "count" => $ngrams[$ngram]["count"] + 1,
                        )
                    );
                } else {
                    $ngrams[$ngram] = (
                        array(
                            "count" => 1,
                        )
                    );
                }
            }
        }

        mb_internal_encoding($beforeEncoding);

        return $ngrams;
    }
}