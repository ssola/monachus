<?php
namespace Monachus\Interfaces;

use Monachus\String as String;

interface TokenizerInterface
{
    public function tokenize(String $string);
}