<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony'                              => true,
        '@Symfony:risky'                        => true,
        'array_syntax'                          => ['syntax' => 'short'],
        'binary_operator_spaces'                => false,
        'combine_consecutive_unsets'            => true,
        'concat_space'                          => [
            'spacing' => 'one',
        ],
        // one should use PHPUnit methods to set up expected exception instead of annotations
        'general_phpdoc_annotation_remove'      => [
            'expectedException',
            'expectedExceptionMessage',
            'expectedExceptionMessageRegExp',
        ],
        'heredoc_to_nowdoc'                     => true,
        'no_extra_consecutive_blank_lines'      => [
            'break',
            'continue',
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'return',
            'square_brace_block',
            'throw',
            'use',
        ],
        'no_short_echo_tag'                     => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else'                       => true,
        'no_useless_return'                     => true,
        'ordered_class_elements'                => true,
        'ordered_imports'                       => true,
        'php_unit_strict'                       => true,
        'phpdoc_add_missing_param_annotation'   => true,
        'phpdoc_order'                          => true,
        'semicolon_after_instruction'           => true,
        'strict_comparison'                     => true,
        'strict_param'                          => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__ . '/app')
            ->in(__DIR__ . '/tests')
    );