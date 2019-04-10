<?php

return [
    'article' => [
        'class' => \App\Article::class,
        'property_path' => 'state',
        'states' => [
            'img_not_saved',
            'img_saved'
        ],
        'transitions' => [
            'save_image' => [
                'from' => ['img_not_saved'],
                'to' => 'img_saved'
            ]
        ],
        'callbacks' => [
            'before' => [
                'store_image' => [
                    'on' => 'save_image',
                    'do' => [App\Services\ArticleService::class, 'saveImage'],
                    'args' => [new Intervention\Image\ImageManager, 'object'],
                ]
            ]
        ]
    ],
];
