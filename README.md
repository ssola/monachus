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
