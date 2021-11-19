<?php

declare(strict_types=1);

use Zorachka\Framework\Directories\DirectoryAlias;

test('DirectoryAlias must have @root and @public items', function () {
    expect(DirectoryAlias::PUBLIC)->toBeString();
    expect(DirectoryAlias::PUBLIC)->not()->toBeEmpty();

    expect(DirectoryAlias::ROOT)->toBeString();
    expect(DirectoryAlias::ROOT)->not()->toBeEmpty();
});
