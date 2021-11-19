<?php

declare(strict_types=1);

namespace Zorachka\Framework\Directories;

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
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->directories);
    }

    /**
     * @inheritDoc
     */
    public function get(string $name): string
    {
        if (!$this->has($name)) {
            throw new DirectoryException("Undefined directory '{$name}'");
        }

        return $this->directories[$name];
    }
}
