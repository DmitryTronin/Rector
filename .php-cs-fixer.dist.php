<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('src/data')
    ->exclude('tools')
    ->exclude('scripts');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer' => true,
    ])
    ->setFinder($finder);