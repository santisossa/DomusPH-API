<?php
$base = __DIR__ . '/../src/';

$folders = [
    'lib',
    'middleware',
    'models',
    'routes',
    'validations'
];

foreach($folders as $f)
{
    foreach (glob($base . "$f/*.php") as $k => $filename)
    {
        require $filename;
    }
}