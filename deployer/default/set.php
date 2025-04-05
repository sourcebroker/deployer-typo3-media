<?php

namespace Deployer;

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
