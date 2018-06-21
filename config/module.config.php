<?php
return [
    'block_layouts' => [
        'invokables' => [
            'simpleBlock' => SimpleBlock\Site\BlockLayout\SimpleBlock::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ],
    ],
];
