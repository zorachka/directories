<?php

declare(strict_types=1);

use Zorachka\Framework\Directories\Directories;
use Zorachka\Framework\Directories\DirectoriesConfig;
use Zorachka\Framework\Directories\DirectoryException;
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
})->throws(DirectoryException::class);

test('FilesystemDirectories should be able check if directory exists', function () {
    $config = DirectoriesConfig::withDefaults([
        '@directory' => __DIR__
    ]);
    $directories = FilesystemDirectories::fromConfig($config);
    expect($directories->has('@directory'))->toBeTrue();
    expect($directories->has('@directories'))->toBeFalse();
});
