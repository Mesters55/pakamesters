<?php

return [
    'imageUpload' => [
        'allowedExtensions' => ['png', 'jpg', 'jpeg'],
        'maxSize' => 500000,
        'directory' => dirname(__FILE__, 2) . '/public/img/uploads/'
    ],
];