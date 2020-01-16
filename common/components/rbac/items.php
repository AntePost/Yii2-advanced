<?php
return [
    'createTask' => [
        'type' => 2,
        'description' => 'Create a task',
    ],
    'updateTask' => [
        'type' => 2,
        'description' => 'Update task',
    ],
    'author' => [
        'type' => 1,
        'children' => [
            'createTask',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'updateTask',
            'author',
        ],
    ],
];
