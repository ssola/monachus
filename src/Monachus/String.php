<?php
namespace Monachus;

class String
{
    const AUTO_UTF_8 = true;
    const MANTAIN_ORIGINAL_CHARSET = false;
    private $string;
    private $charset = null;

    public function __construct($string = "", $auto_utf8 = true)
    {
        $this->string = $string;

        if ($this->getCharset() != "UTF-8" && $auto_utf8 == self::AUTO_UTF_8)
            $this->setCharset("UTF-8");
    }

    public function length()
    {
        return mb_strlen($this->string, $this->getCharset());
    }

    public function equals($string)
    {
        if($this->string === $string)
            return true;

        return false;
    }

    public function substract($start, $length)
    {
        return mb_substr($this->string, $start, $length, $this->getCharset());
    }

    public function find(String $needle)
    {
        return mb_strpos($this->string, $needle, 0, $this->getCharset());
    }

    public function setCharset($newCharset)
    {
        if($this->charset == $newCharset)
            return true;

        $this->string = iconv($this->getCharset(), $newCharset, $this->string);
    }

    public function getCharset()
    {
        return $this->detectCharset();
    }

    public function __toString()
    {
        return $this->string;
    }

    private function detectCharset()
    {
        return mb_detect_encoding($this->string);
    }
}