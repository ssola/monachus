Monachus [![Build Status](https://travis-ci.org/ssola/monachus.png?branch=master)](https://travis-ci.org/ssola/monachus)
========

Library to handle any kind of text in any language and alphabet. Every single PHP developer knows about the troubles to work with different languages and charsets. For example, imagine do you want to find a substring
inside a primary string, but that string is written in Japanese or Arabic. You can't use the common tools (strlen, substr, ...) because PHP (at the moment) doesn't have a good UTF-8 support at all. With Monachus
this should be fixed in an easy way.

How it works
------------

**String**
______

The first thing we need to know is how to use the String class, this class generates an object with a specific text. It will preserve the text in UTF-8 charset along the way.

```php
include_once("./vendor/autoload.php");

use Monachus\String as String;

$text = new String("Hello World!");
echo $text;
```

Obviously this code is generating a new String object with a value and then print it.

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

Do you need to tokenize a string? Monachus can do it for you! We support a lot of languages, Japanese included! But if your language is not supported you can create your own Tokenizer easily, let's see how it works.

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

As you seen we can use our own adapters in order to tokenize complex languages like Japanase or Chinese. Now is time to explain how you can create this adapters.

```php
class MyAdapter implements Monachus\Interfaces\TokenizerInterface
{
  public function tokenize(Monachus\String $string)
  {
    // your awesome code!
  }
}

$tokenizer = new Monachus\Tokenizer(new MyAdapter());
var_dump($tokenizer->tokenize(new Monachus\String("Поиск информации в интернете"));
```

