<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/resources/views',
        __DIR__ . '/routes',
    ])
    ->exclude(['bootstrap', 'storage', 'vendor'])
    ->name('*.php')
//    ->name('_ide_helper')
//    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = (new \PhpCsFixer\Config())
    ->setRules([
        // '@DoctrineAnnotation' => true,
        '@PER'                                   => true,
        // '@PHP56Migration:risky' => true,
        // '@PHP70Migration' => true,
        // '@PHP70Migration:risky' => true,
        // '@PHP71Migration' => true,
        // '@PHP71Migration:risky' => true,
        // '@PHP73Migration' => true,
        '@PHP74Migration'                        => true,
        // '@PHP74Migration:risky' => true,
        // '@PHP80Migration' => true,
        // '@PHP80Migration:risky' => true,
        // '@PHP81Migration' => true,
        // '@PHP82Migration' => true,
        // '@PHPUnit100Migration:risky' => true,
        // '@PHPUnit30Migration:risky' => true,
        // '@PHPUnit32Migration:risky' => true,
        // '@PHPUnit35Migration:risky' => true,
        // '@PHPUnit43Migration:risky' => true,
        // '@PHPUnit48Migration:risky' => true,
        // '@PHPUnit50Migration:risky' => true,
        // '@PHPUnit52Migration:risky' => true,
        // '@PHPUnit54Migration:risky' => true,
        // '@PHPUnit55Migration:risky' => true,
        // '@PHPUnit56Migration:risky' => true,
        // '@PHPUnit57Migration:risky' => true,
        // '@PHPUnit60Migration:risky' => true,
        '@PHPUnit75Migration:risky'              => true,
        // '@PHPUnit84Migration:risky' => true,
        '@PSR1'                                  => true,
        '@PSR2'                                  => true,
        '@PSR12'                                 => true,
        // '@PSR12:risky' => true,
        // '@PhpCsFixer' => true,
        // '@PhpCsFixer:risky' => true,
        '@Symfony'                               => true,
        // '@Symfony:risky' => true,

        // personal rules
        'binary_operator_spaces'                 => [
            'operators' => [
                '=>'  => 'align_single_space_by_scope',
                '='   => 'align_single_space_minimal',
                '??=' => 'align_single_space_minimal',
                '+='  => 'align_single_space_minimal',
                '-='  => 'align_single_space_minimal',
                '&='  => 'align_single_space_minimal',
                '*='  => 'align_single_space_minimal',
                '%='  => 'align_single_space_minimal',
                '<<=' => 'align_single_space_minimal',
                '>>=' => 'align_single_space_minimal',
            ],
        ],
        'array_syntax'                           => ['syntax' => 'short'],
        'ordered_class_elements'                 => true,

        'no_unused_imports'                      => true,
        'ordered_imports'                        => ['sort_algorithm' => 'alpha', 'imports_order' => ['const', 'class', 'function']],
        'single_import_per_statement'            => true,
        'single_line_after_imports'              => true,

        'multiline_whitespace_before_semicolons' => false,
        'cast_spaces'                            => ['space' => 'none'],
        'concat_space'                           => ['spacing' => 'one'],
        'combine_consecutive_unsets'             => true,
        'no_homoglyph_names'                     => true,
    ])
    ->setIndent('    ')
    ->setRiskyAllowed(true)
    ->setHideProgress(false)
    ->setUsingCache(false)
    ->setFinder($finder);

return $config;
