<?php
/*
Based on: http://eliteinformatiker.de/2012/07/02/easy-japanese-tokenization-text-hiragana-katakana-kanji/
*/
namespace Monachus\Tokenizers;

use Monachus\Interfaces as Interfaces;
use Monachus\String as String;

class Japanase implements Interfaces\TokenizerInterface
{
    private $hiragana = array(
        'あ', 'い', 'う', 'え', 'お',
        'か', 'き', 'く', 'け', 'こ',
        'さ', 'し', 'す', 'せ', 'そ',
        'た', 'ち', 'つ', 'て', 'と',
        'な', 'に', 'ぬ', 'ね', 'の',
        'は', 'ひ', 'ふ', 'へ', 'ほ',
        'ま', 'み', 'む', 'め', 'も',
        'や',      'ゆ',      'よ',
        'ら', 'り', 'る', 'れ', 'ろ',
        'わ', 'ゐ',      'ゑ', 'を',
                            'ん',
        'が', 'ぎ', 'ぐ', 'げ', 'ご',
        'ざ', 'じ', 'ず', 'ぜ', 'ぞ',
        'だ', 'ぢ', 'づ', 'で', 'ど',
        'ば', 'び', 'ぶ', 'べ', 'ぼ',
        'ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ',
 
        'ぁ', 'ぃ', 'ぅ', 'ぇ', 'ぉ',
    );

    private $katakana = array(
        'ア', 'イ', 'ウ', 'エ', 'オ', 
        'カ', 'キ', 'ク', 'ケ', 'コ', 
        'サ', 'シ', 'ス', 'セ', 'ソ', 
        'タ', 'チ', 'ツ', 'テ', 'ト', 
        'ナ', 'ニ', 'ヌ', 'ネ', 'ノ', 
        'ハ', 'ヒ', 'フ', 'ヘ', 'ホ', 
        'マ', 'ミ', 'ム', 'メ', 'モ', 
        'ヤ',      'ユ',      'ヨ', 
        'ラ', 'リ', 'ル', 'レ', 'ロ', 
        'ワ', 'ヰ',      'ヱ', 'ヲ', 
                            'ン',
        'ガ', 'ギ', 'グ', 'ゲ', 'ゴ', 
        'ザ', 'ジ', 'ズ', 'ゼ', 'ゾ', 
        'ダ', 'ヂ', 'ヅ', 'デ', 'ド', 
        'バ', 'ビ', 'ブ', 'ベ', 'ボ', 
        'パ', 'ピ', 'プ', 'ペ', 'ポ', 
 
        'ァ', 'ィ', 'ゥ', 'ェ', 'ォ', 
        'ー',
    );
 
    const HIRAGANA = 0x1;
    const KATAKANA = 0x2;
    const KANJI = 0x4;

    public function tokenize(String $string)
    {
        $beforeEncoding = mb_internal_encoding();
        mb_internal_encoding($string->getCharset());

        $tokens = new \ArrayObject();;
 
        $currentSystem = null;
        $currentToken = '';
        $length = $string->length();
 
        for ($i = 0; $i <= $length; $i++) {
            $character = $string->substract($i, 1);
 
            if (in_array($character, $this->hiragana)) {
                $system = self::HIRAGANA;
            } elseif (in_array($character, $this->katakana)) {
                $system = self::KATAKANA;
            } else {
                $system = self::KANJI;
            }
 
            // First string did not have a starting system
            if ($currentSystem == null) {
                $currentSystem = $system;
            }
 
            // if the system still is the same, no boundary has been reached
            if ($currentSystem == $system) {
                $currentToken .= $character;
            } else {
                // Write ended token to tokens and start a new one
                $tokens->append($currentToken);
                $currentToken = $character;
                $currentSystem = $system;
            }
        }

        mb_internal_encoding($beforeEncoding);
 
        return $tokens;
    }
}