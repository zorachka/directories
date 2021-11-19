<?php

declare(strict_types=1);

use Zorachka\Framework\Directories\DirectoriesConfig;

test('DirectoriesConfig should be able to be created with defaults', function () {
    $config = DirectoriesConfig::withDefaults();

    expect($config->directories())->toBeArray();
    expect($config->directories())->toBeEmpty();
});

test('DirectoriesConfig should be able to add new directory', function () {
    $config = DirectoriesConfig::withDefaults();
    $newConfig = $config->withDirectory('@directory', __DIR__);

    expect($newConfig->directories())->toMatchArray(['@directory' => __DIR__  . '/']);
});
