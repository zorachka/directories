<?php

declare(strict_types=1);

namespace Zorachka\Framework\Directories;

use Zorachka\Framework\Directories\Exception\CouldNotFindDirectoryWithAlias;

final class FilesystemDirectories implements Directories
{
    private array $directories;

    private function __construct(array $directories)
    {
        $this->directories = $directories;
    }

    public static function fromConfig(DirectoriesConfig $config): self
    {
        return new self(
            $config->directories()
        );
    }

    /**
     * @inheritDoc
     */
    public function has(string $alias): bool
    {
        return array_key_exists($alias, $this->directories);
    }

    /**
     * @inheritDoc
     */
    public function get(string $alias): string
    {
        if (!$this->has($alias)) {
            throw new CouldNotFindDirectoryWithAlias(
                \sprintf('Undefined directory with alias %s', $alias)
            );
        }

        return $this->directories[$alias];
    }
}
