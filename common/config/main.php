<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile'       => '@vendor/../common/components/rbac/items.php',
            'assignmentFile' => '@vendor/../common/components/rbac/assignments.php',
            'ruleFile'       => '@vendor/../common/components/rbac/rules.php'
        ],
    ],
];
