<?php
namespace Monachus\Ngram;

class NgramHeap extends \SplHeap
{
    public function compare($ngramA, $ngramB)
    {
        if($ngramA['frequency'] === $ngramB['frequency'])
            return 0;

        return $ngramA['frequency'] < $ngramB['frequency'] ? -1 : 1;
    }
}