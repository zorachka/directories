<?php

declare(strict_types=1);

namespace Zorachka\Framework\Directories;

use Zorachka\Framework\Directories\Exception\CouldNotFindDirectoryWithAlias;

interface Directories
{
    /**
     * Check if directory exists.
     * @param string $alias
     * @return bool
     */
    public function has(string $alias): bool;

    /**
     * Get directory.
     * @param string $alias
     * @return string
     * @throws CouldNotFindDirectoryWithAlias When no directory found.
     */
    public function get(string $alias): string;
}
