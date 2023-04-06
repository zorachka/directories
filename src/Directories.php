<?php

declare(strict_types=1);

namespace Zorachka\Directories;

use Zorachka\Directories\Exception\CouldNotFindDirectoryWithAlias;

interface Directories
{
    /**
     * Check if directory exists.
     */
    public function has(string $alias): bool;

    /**
     * Get directory.
     * @throws CouldNotFindDirectoryWithAlias When no directory found.
     */
    public function get(string $alias): string;
}
