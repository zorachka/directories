<?php

declare(strict_types=1);

use Zorachka\Framework\Directories\Directories;
use Zorachka\Framework\Directories\DirectoriesConfig;
use Zorachka\Framework\Directories\DirectoriesServiceProvider;

test('DirectoriesServiceProvider should contain definitions', function () {
    expect(
        array_keys(DirectoriesServiceProvider::getDefinitions())
    )->toMatchArray([
        Directories::class,
        DirectoriesConfig::class,
    ]);
});
