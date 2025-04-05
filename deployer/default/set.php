<?php

namespace Deployer;

set('web_path', function () {
    $composerConfig = null;
    if (file_exists('./composer.json')) {
        $composerContent = file_get_contents('./composer.json');
        if ($composerContent !== false) {
            $composerConfig = json_decode($composerContent, true);
        }
    }

    if (isset($composerConfig['extra']['typo3/cms']['web-dir'])) {
        return rtrim($composerConfig['extra']['typo3/cms']['web-dir'], '/') . '/';
    }

    return 'public/';
});

set('media', function () {
    return [
        'filter' => [
            '+ /' . get('web_path'),
            '+ /' . get('web_path') . 'fileadmin/',
            '- /' . get('web_path') . 'fileadmin/_processed_/*',
            '+ /' . get('web_path') . 'fileadmin/**',
            '- *'
        ]
    ];
});
