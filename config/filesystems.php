<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
        'tabfiles' => [
            'driver' => 'local',
            'root' => '/var/www/dev/tabfiles',
            // 'root' => '/var/www/tabfiles',
            // 'root'   => 'c:/tabfiles',
            // 'root'   => 'E:/NTA/tabfiles',
        ],
        'kmlfiles' => [
            'driver' => 'local',
            'root' => '/var/www/dev/kmlfiles',
            // 'root' => '/var/www/kmlfiles',
            // 'root'   => 'c:/kmlfiles',
            // 'root'   => 'e:/NTA/kmlfiles',
        ],
        'backupfiles' => [
            'driver' => 'local',
            //to be defined location in the server
            'root' => '/var/www/dev/autobackup',
            // 'root' => '/var/www/autobackup',
            // 'root'   => 'e:/autobackupfiles',
        ],
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'endpoint' => env('AWS_URL'),
        ],

    ],

];
