Monachus [![Build Status](https://travis-ci.org/ssola/monachus.png?branch=master)](https://travis-ci.org/ssola/monachus)
========

Monachus is a library to help your working with text, from any language. Monachus means Monk in Latin language, I think it's an good name to define this library, they were used to work a lot with books (strings) in a lot of languages.

This library has been created to having in mind these PHP versions: 5.5, 5.4, 5.3

How it works
------------

**String**
______

The first thing we need to know is how to use the String class, this class generates an object with a specific text. It will preserve that text in UTF-8 charset along the way.

```php
include_once("./vendor/autoload.php");

use Monachus\String as String;

$text = new String("Hello World!");
echo $text;
```

Obviously this code is generating a new String object with a value and then it's printed.

Then you can do things like:

```php
include_once("./vendor/autoload.php");

use Monachus\String as String;

$text = new String("Hello World!");
echo $text->length();
echo $text->find("World");
echo $text->toUppercase();

if($text->equals("Hello World!"))
  echo $text->toLowercase();
```

This kind of objects is used extensively in this library in order to perform all the actions with the proper charset.

**Tokenizer**
_____________

Do you need to tokenize a string? Monachus can do it for you! We support a lot of languages, Japanese included! But if your language is not supported... relax! You can create your own adapters in order to tokenize different languages.

Let's do a simple example:

```php
include_once("./vendor/autoload.php");

use Monachus\String as String;
use Monachus\Tokenizer as Tokenizer;

$text = new String("This is a text");
$tokenizer = new Tokenizer();

var_dump($tokenizer->tokenize($text));

// Now imagine you need to tokenize a Japanase text
$textJp = new String("は太平洋側を中心に晴れた所が多いが");
$tokenizerJp = new Tokenizer(new Monachus\Tokenizers\Japanase());

var_dump($tokenizerJp);
```

As you seen we can use our own adapters in order to tokenize complex languages like Japanase or Chinese. Now it's time to explain you how to create these adapters.

```php
class MyTokenizer implements Monachus\Interfaces\TokenizerInterface
{
  public function tokenize(Monachus\String $string)
  {
    // your awesome code!
  }
}

$tokenizer = new Monachus\Tokenizer(new MyTokenizer());
var_dump($tokenizer->tokenize(new Monachus\String("Поиск информации в интернете"));
```

**N-Gram**
__________

Yeah! Monachus is able to generate different levels of N-gram sequences, for example a bigram or trigram. But let's see how it works.

```php
include_once("./vendor/autoload.php");

use Monachus\String as String;
use Monachus\Ngram as Ngram;
use Monachus\Config as Config;

$text = new String("This is an awesome text");

$config = new Config();
$config->max = 3; // we're creating trigrams.

$ngram = new Ngram($config);
var_dump($ngram->parse($text));
```
Do you need your own N-gram parser? Sure! You can create your own parsers as well.

```php
class MyParser implements Monachus\Interfaces\NgramParserInterface
{
  public function parse(String $string, $level)
  {
    // your awesome code!
  }
}
```

And now...

```php
include_once("./vendor/autoload.php");

use Monachus\String as String;
use Monachus\Ngram as Ngram;
use Monachus\Config as Config;

$text = new String("This is an awesome text");

$config = new Config();
$config->max = 3; // we're creating trigrams.

$ngram = new Ngram($config);
$ngram->setParser(new MyParser());
var_dump($ngram->parse($text));
```
