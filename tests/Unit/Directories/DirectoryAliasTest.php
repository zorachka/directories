<?php

declare(strict_types=1);

use Zorachka\Framework\Directories\DirectoryAlias;

test('DirectoryAlias must have @root item', function () {
    expect(DirectoryAlias::ROOT)->toBeString();
    expect(DirectoryAlias::ROOT)->not()->toBeEmpty();
});
