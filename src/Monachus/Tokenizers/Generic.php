<?php
namespace Monachus\Tokenizers;

use Monachus\Interfaces as Interfaces;
use Monachus\String as String;

class Generic implements Interfaces\TokenizerInterface
{
    public function tokenize (String $string)
    {
        return preg_split('/([\s\-_,:;?!\/\(\)\[\]{}<>\r\n"]|(?<!\d)\.(?!\d))/',
                    $string, null, PREG_SPLIT_NO_EMPTY);
    }
}