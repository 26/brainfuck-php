#!/usr/bin/env php
<?php

require '../src/Brainfuck.php';

if(!isset($argv[1]) || empty($argv[1])) {
    printf("Usage: php %s file [input]\n", $argv[0]);

    exit();
}

if(!file_exists($argv[1])) {
    printf("Error: %s not found\n", $argv[1]);

    exit();
}

$code = file_get_contents($argv[1]);

$brainfuck = new Brainfuck();

unset($argv[0], $argv[1]);
$brainfuck->setup($code, implode(' ', $argv));
$brainfuck->run();

echo "\n";

?>