<?php

declare(strict_types=1);

use Zorachka\Framework\Directories\Directories;
use Zorachka\Framework\Directories\DirectoriesConfig;
use Zorachka\Framework\Directories\Exception\CouldNotFindDirectoryWithAlias;
use Zorachka\Framework\Directories\FilesystemDirectories;

test('FilesystemDirectories should can be created from DirectoriesConfig', function () {
    $config = DirectoriesConfig::withDefaults([
        '@directory' => __DIR__
    ]);
    $directories = FilesystemDirectories::fromConfig($config);

    expect($directories)->toBeInstanceOf(Directories::class);
    expect($directories->has('@directory'))->toBeTrue();
    expect($directories->get('@directory'))->toBe(__DIR__ . '/');
});

test('FilesystemDirectories should throw exception if directory doesn`t exists', function () {
    $config = DirectoriesConfig::withDefaults([
        '@directory' => __DIR__
    ]);
    $directories = FilesystemDirectories::fromConfig($config);
    $directories->get('@directories');
})->throws(CouldNotFindDirectoryWithAlias::class);

test('FilesystemDirectories should be able check if directory exists', function () {
    $config = DirectoriesConfig::withDefaults([
        '@directory' => __DIR__
    ]);
    $directories = FilesystemDirectories::fromConfig($config);
    expect($directories->has('@directory'))->toBeTrue();
    expect($directories->has('@directories'))->toBeFalse();
});

test('FilesystemDirectories should be able resolve directory with alias', function () {
    $config = DirectoriesConfig::withDefaults([
        '@root' => __DIR__,
        '@public' => '@root/public'
    ]);
    $directories = FilesystemDirectories::fromConfig($config);
    expect($directories->get('@public'))->toBe(__DIR__ . '/public/');
});

test('FilesystemDirectories should throw exception if directory with alias doesn\'t exists', function () {
    $config = DirectoriesConfig::withDefaults([
        '@main' => __DIR__,
        '@public' => '@root/public'
    ]);
    $directories = FilesystemDirectories::fromConfig($config);
    $directories->get('@public');
})->throws(CouldNotFindDirectoryWithAlias::class);
