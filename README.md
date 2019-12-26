## PHP Brainfuck interpreter

This is a Brainfuck interpreter written in PHP. Brainfuck is an
esoteric programming language created by Urban Müller. It is notable
for its extreme minimalism.

### Usage

This interpreter can be used directly from PHP or using a CLI.

#### PHP
```php
$code = "++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++
         .>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.
         ------.--------.>+.>.";

$input = "This gets read by Brainfuck...";

$brainfuck = new Brainfuck();
$brainfuck->setup($code, $input);

$brainfuck->run();
```

#### CLI
```
$ php /dir/to/bin/brainfuck.php example.txt Input to Brainfuck...
```

### Installation
Clone this project using:

```
$ git clone https://github.com/Pancake/brainfuck-php
```

and include the source file with:

```php
require_once "brainfuck-php/src/Brainfuck.php";
```

### License
Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php