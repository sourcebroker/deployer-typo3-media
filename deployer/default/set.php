<?php

namespace Deployer;

// Look https://github.com/sourcebroker/deployer-extended-media for docs
set('media_allow_push_live', false);
set('media_allow_copy_live', false);
set('media_allow_link_live', false);
set('media_allow_pull_live', false);
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
