<?php

declare(strict_types=1);

use Ibexa\CodeStyle\PhpCsFixer\Config;

$config = new Config();
$config->setFinder(
    PhpCsFixer\Finder::create()
        ->in(__DIR__ . '/src')
        ->in(__DIR__ . '/tests')
        ->files()->name('*.php')
);

return $config;
